<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficialPlaylists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankedplaylists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('server_name');
            $table->text('message');
            $table->tinyInteger('max_players');
            $table->tinyInteger('vote_mode')->default(1); // Veto
            $table->tinyInteger('number_of_revotes')->default(1);
            $table->timestamps();
        });

        Schema::create('socialplaylists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('server_name');
            $table->text('message');
            $table->tinyInteger('max_players');
            $table->tinyInteger('vote_mode')->default(0); // Voting
            $table->tinyInteger('number_of_revotes')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialplaylists');
        Schema::dropIfExists('rankedplaylists');
    }
}
