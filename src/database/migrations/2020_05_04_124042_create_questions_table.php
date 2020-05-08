<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {

            //Questions schema
            $table->increments('id'); //auto increment the ID
            $table->string('title');
            $table->string('slug'); //slug is the SEO friendly URL spaces replaces by hyphens. ex: test.com/how-are-you. Laravel has in-built generator - str_slug($string)
            $table->text('body');
            $table->timestamps();

            //Dependencies
            // "Unsigned numbers can only be positive or zero"
            $table->integer('category_id')->unsigned(); // category ID of the question
            $table->integer('user_id')->unsigned(); // user ID of the question
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
