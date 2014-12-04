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
            $table->binary('image')->nullable(true);
            $table->date('birth');
            $table->string('city');
            $table->string('school');
            $table->string('google')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('language')->default('sk');
            $table->string('about')->nullable(true);
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable(true);
            $table->boolean('ban')->default(0);
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
