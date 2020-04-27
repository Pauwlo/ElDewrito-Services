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

        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('file_name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('file_name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->string('command')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('variant_id');
            $table->boolean('can_be_veto_result');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('map_id')
                  ->references('id')
                  ->on('maps')
                  ->onDelete('cascade');

            $table->foreign('variant_id')
                  ->references('id')
                  ->on('variants')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('commands');
        Schema::dropIfExists('variants');
        Schema::dropIfExists('maps');
        Schema::dropIfExists('socialplaylists');
        Schema::dropIfExists('rankedplaylists');
    }
}
