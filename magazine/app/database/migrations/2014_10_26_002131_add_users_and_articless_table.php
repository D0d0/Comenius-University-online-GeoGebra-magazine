<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersAndArticlessTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_groups', function($table) {
            $table->increments('id')->unsigned();
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('users', function($table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->integer('rank')->unsigned();
            $table->foreign('rank')->references('id')->on('user_groups');
            $table->binary('image');
            $table->date('birth');
            $table->string('city');
            $table->string('school');
            $table->string('google');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('language')->default('sk');
            $table->dateTime('about');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
        Schema::drop('user_groups');
        Schema::drop('articles');
    }

}
