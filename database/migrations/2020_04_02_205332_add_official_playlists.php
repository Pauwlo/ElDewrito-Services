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
        Schema::create('op_rankedplaylists', function (Blueprint $table) {
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

        Schema::create('op_socialplaylists', function (Blueprint $table) {
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

        Schema::create('op_maps', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('file_name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('op_variants', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('file_name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('op_commands', function (Blueprint $table) {
            $table->id();
            $table->string('command')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('op_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('variant_id');
            $table->boolean('can_be_veto_result');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('map_id')
                  ->references('id')
                  ->on('op_maps')
                  ->onDelete('cascade');

            $table->foreign('variant_id')
                  ->references('id')
                  ->on('op_variants')
                  ->onDelete('cascade');
        });

        Schema::create('op_option_rankedplaylist', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('rankedplaylist_id');

            $table->primary(['option_id', 'rankedplaylist_id']);

            $table->foreign('option_id')
                  ->references('id')
                  ->on('op_options')
                  ->onDelete('cascade');

            $table->foreign('rankedplaylist_id')
                  ->references('id')
                  ->on('op_rankedplaylists')
                  ->onDelete('cascade');
        });

        Schema::create('op_map_socialplaylist', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('socialplaylist_id');

            $table->primary(['map_id', 'socialplaylist_id']);

            $table->foreign('map_id')
                  ->references('id')
                  ->on('op_maps')
                  ->onDelete('cascade');

            $table->foreign('socialplaylist_id')
                  ->references('id')
                  ->on('op_socialplaylists')
                  ->onDelete('cascade');
        });

        Schema::create('op_socialplaylist_variant', function (Blueprint $table) {
            $table->unsignedBigInteger('socialplaylist_id');
            $table->unsignedBigInteger('variant_id');

            $table->primary(['socialplaylist_id', 'variant_id']);

            $table->foreign('socialplaylist_id')
                  ->references('id')
                  ->on('op_socialplaylists')
                  ->onDelete('cascade');

            $table->foreign('variant_id')
                  ->references('id')
                  ->on('op_variants')
                  ->onDelete('cascade');
        });

        Schema::create('op_command_variant', function (Blueprint $table) {
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('variant_id');

            $table->primary(['command_id', 'variant_id']);

            $table->foreign('command_id')
                  ->references('id')
                  ->on('op_commands')
                  ->onDelete('cascade');
            
            $table->foreign('variant_id')
                  ->references('id')
                  ->on('op_variants')
                  ->onDelete('cascade');
        });

        Schema::create('op_map_variant', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id');
            $table->unsignedBigInteger('variant_id');

            $table->primary(['map_id', 'variant_id']);

            $table->foreign('map_id')
                  ->references('id')
                  ->on('op_maps')
                  ->onDelete('cascade');

            $table->foreign('variant_id')
                  ->references('id')
                  ->on('op_variants')
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
        Schema::dropIfExists('op_map_variant');
        Schema::dropIfExists('op_command_variant');
        Schema::dropIfExists('op_socialplaylist_variant');
        Schema::dropIfExists('op_map_socialplaylist');
        Schema::dropIfExists('op_option_rankedplaylist');
        Schema::dropIfExists('op_options');
        Schema::dropIfExists('op_commands');
        Schema::dropIfExists('op_variants');
        Schema::dropIfExists('op_maps');
        Schema::dropIfExists('op_socialplaylists');
        Schema::dropIfExists('op_rankedplaylists');
    }
}
