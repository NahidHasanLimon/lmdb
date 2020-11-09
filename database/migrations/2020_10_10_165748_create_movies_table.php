<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('release_year');
            $table->string('description')->nullable();
            $table->string('photo')->nullable();  
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->unsignedBigInteger('o_t_t_provider_id')->nullable();
            $table->foreign('o_t_t_provider_id')->references('id')->on('o_t_t_providers');
            $table->string('imdb_link')->nullable();
            $table->double('imdb_rating')->nullable();
            $table->string('rotten_tomatoes_link')->nullable();
            $table->double('rotten_tomatoes_rating')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
