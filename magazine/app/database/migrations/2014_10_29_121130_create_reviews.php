<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviews extends Migration {

	public function up()
	{
         Schema::create('reviews', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_article')->unsigned();
            $table->foreign('id_article')->references('id')->on('article');
            $table->integer('reviewer_id')->unsigned();
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->string('text');
            $table->timestamp('time');
            });
	}


	public function down()
	{
            Schema::dropIfExists('reviews');	
	}

}
