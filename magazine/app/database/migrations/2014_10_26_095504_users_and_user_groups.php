<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAndUserGroups extends Migration {

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
            $table->string('password');
            $table->string('email')->unique();
            $table->binary('image');
            $table->date('birth');
            $table->string('city');
            $table->string('school');
            $table->string('google');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('language')->default('sk');
            $table->string('about');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('user_roles', function($table){
           $table->increments('id')->unsigned();
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users');
           $table->integer('rank_id')->unsigned();
           $table->foreign('rank_id')->references('id')->on('user_groups');
           $table->timestamps(false);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('user_groups');
        Schema::dropIfExists('users');
    }

}
