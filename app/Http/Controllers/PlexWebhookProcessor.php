<?php

namespace App\Http\Controllers;

use App\Exceptions\UnableToAcquireLock;
use App\Models\Movie;
use App\Models\PlexAccount;
use App\Models\PlexWebhookProcessLock;
use App\Models\PlexWebhookRequest;
use App\Models\TvEpisode;
use App\Models\Track;
use Illuminate\Http\Request;
use \stdClass;

class PlexWebhookProcessor extends Controller
{
  public function process() {
    try {
      $lock = $this->acquireLock();

      while ($request = PlexWebhookRequest::first()) {
        $data = json_decode($request->request);

        switch ($data->Metadata->type) {
          case 'episode':
            $requestType = 'TvEpisode';
            break;
          case 'movie':
            $requestType = 'Movie';
            break;
          case 'track':
            $requestType = 'Track';
            break;
          default:
            $requestType = 'Unknown';
        }

        $processFunc = 'process' . $requestType;
        $this->$processFunc($data);
        $request->delete();
        $lock->touch();
      }
    } catch (UnableToAcquireLock $e) {
      return;
    } finally {
      if (isset($lock)) {
        $lock->delete();
      }
    }
  }

  private function acquireLock(): PlexWebhookProcessLock {
    PlexWebhookProcessLock::where(
      'updated_at',
      '<',
      date('Y-m-d H:i:s', time() - 3600)
    )->delete();

    $locked = PlexWebhookProcessLock::first();

    if ($locked) {
      throw new UnableToAcquireLock();
    }

    $lock = new PlexWebhookProcessLock();
    $lock->id = (string) time();
    $lock->saveOrFail();

    $locked = PlexWebhookProcessLock::where(
      'created_at',
      '<',
      $lock->created_at
    )->first();

    if ($locked) {
      $lock->delete();
      throw new UnableToAcquireLock();
    }

    return $lock;
  }

  private function processCommon(stdClass $data) {
    $id = $data->Account->title;

    if (!($model = PlexAccount::find($id))) {
      $model = new PlexAccount();
      $model->id = $id;
      $model->saveOrFail();
    }
  }

  private function processMovie(stdClass $data) {
    $this->processCommon($data);
    $this->upsertMovie($data);
  }

  private function processTrack(stdClass $data) {
    $this->processCommon($data);
    $this->upsertTrack($data);
  }

  private function processTvEpisode(stdClass $data) {
    $this->processCommon($data);
    $this->upsertEpisode($data);
  }

  private function processUnknown(stdClass $data) {
    return;
  }

  private function upsertEpisode(stdClass $data) {
    $name = $data->Metadata->title;
    $season = $data->Metadata->parentTitle;
    $show = $data->Metadata->grandparentTitle;

    if (!(
      $model = TvEpisode::where('tv_show', $show)
        ->where('tv_season', $season)
        ->where('name', $name)
        ->first()
    )) {
      $model = new TvEpisode();
      $model->name = $name;
      $model->tv_season = $season;
      $model->tv_show = $show;
    }

    $model->episode_index = $data->Metadata->index;
    $model->season_index = $data->Metadata->parentIndex;
    $model->saveOrFail();

    $model->plexAccounts()->syncWithoutDetaching([
      $data->Account->title => ['rating' => ceil($data->rating / 2)],
    ]);
  }

  private function upsertMovie(stdClass $data) {
    $name = $data->Metadata->title;
    $year = $data->Metadata->year;

    if (!(
      $model = Movie::where('name', $name)->where('year', $year)->first()
    )) {
      $model = new Movie();
      $model->name = $name;
      $model->year = $year;
      $model->saveOrFail();
    }

    $model->plexAccounts()->syncWithoutDetaching([
      $data->Account->title => ['rating' => ceil($data->rating / 2)],
    ]);
  }

  private function upsertTrack(stdClass $data) {
    $album = $data->Metadata->parentTitle;
    $artist = $data->Metadata->grandparentTitle;
    $name = $data->Metadata->title;

    if (!(
      $model = Track::where('album', $album)
        ->where('artist', $artist)
        ->where('name', $name)
        ->first()
    )) {
      $model = new Track();
      $model->album = $album;
      $model->artist = $artist;
      $model->name = $name;
    }

    $model->track_number = $data->Metadata->index;
    $model->saveOrFail();

    $model->plexAccounts()->syncWithoutDetaching([
      $data->Account->title => ['rating' => ceil($data->rating / 2)],
    ]);
  }
}

