<?php

use Illuminate\Database\Migrations\Migration;

class CreateTagsAndTagGroups extends Migration {

    public function up() {
        Schema::create('tag_groups', function($table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->integer('count')->unsigned()->default(0);
        });
        Schema::create('tags', function($table) {
            $table->increments('id')->unsigned();
            $table->integer('id_tag')->unsigned();
            $table->foreign('id_tag')->references('id')->on('tag_groups');
            $table->integer('id_article')->unsigned();
            $table->foreign('id_article')->references('id')->on('articles');
        });
    }

    public function down() {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_groups');
    }

}
