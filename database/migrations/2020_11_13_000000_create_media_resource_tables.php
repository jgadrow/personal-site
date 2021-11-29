<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaResourceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_plex_account', function (Blueprint $table) {
            $table->integer('rating');
            $table->string('movie_id');
            $table->string('plex_account_id');
            $table->primary(['movie_id', 'plex_account_id']);
        });

        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('year');
            $table->primary('id');
            $table->unique(['name', 'year']);
        });

        Schema::create('plex_account_track', function (Blueprint $table) {
            $table->integer('rating');
            $table->string('plex_account_id');
            $table->string('track_id');
            $table->primary(['plex_account_id','track_id']);
        });

        Schema::create('plex_account_tv_episode', function (Blueprint $table) {
            $table->integer('rating');
            $table->string('plex_account_id');
            $table->string('tv_episode_id');
            $table->primary(['plex_account_id','tv_episode_id']);
        });

        Schema::create('plex_accounts', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
        });

        Schema::create('tracks', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->integer('track_number');
            $table->string('album');
            $table->string('artist');
            $table->primary('id');
            $table->unique(['name', 'album', 'artist']);
        });

        Schema::create('tv_episodes', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->integer('episode_index');
            $table->string('tv_season');
            $table->integer('season_index');
            $table->string('tv_show');
            $table->primary('id');
            $table->unique(['name', 'tv_season', 'tv_show']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_plex_account');
        Schema::dropIfExists('movies');
        Schema::dropIfExists('plex_account_track');
        Schema::dropIfExists('plex_account_tv_episode');
        Schema::dropIfExists('plex_accounts');
        Schema::dropIfExists('tracks');
        Schema::dropIfExists('tv_episodes');
    }
}
