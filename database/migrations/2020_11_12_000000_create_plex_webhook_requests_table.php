<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlexWebhookRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plex_webhook_process_locks', function (Blueprint $table) {
            $table->string('id');
            $table->timestamps();
            $table->primary('id');
        });

        Schema::create('plex_webhook_requests', function (Blueprint $table) {
            $table->string('id');
            $table->longText('request');
            $table->timestamps();
	    $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plex_webhook_process_locks');
        Schema::dropIfExists('plex_webhook_requests');
    }
}

