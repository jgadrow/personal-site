<?php

namespace App\Http\Controllers;

use App\Models\PlexWebhookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlexWebhookRequestController extends Controller
{
  private $servers = [
    'b531012dbfc7549ba9823fd89de98b9165e28667', // Sovrin Media
    '783f5d8ca6cb3b1b7960340c8718b20a9ae4ef34', // Jeremy's NAS
  ];

  public function store(Request $request) {
    $data = json_decode($request->payload);

    if (
      'media.rate' != $data->event
      || !in_array($data->Server->uuid, $this->servers)
    ) {
      return;
    }

    $record = new PlexWebhookRequest;
    $record->id = (string) time();
    $record->request = $request->payload;
    $record->save();
    exec("curl https://www.jgadrow.com/process-plex-webhooks > /dev/null 2>&1 &");
  }
}

