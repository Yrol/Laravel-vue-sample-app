<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id'); //Auto increment the ID
            $table->text('body');
            $table->timestamps();

            //Dependencies
            $table->integer('question_id')->unsigned();
            $table->integer('user_id');

            //Foreign key for deleting (cascading) all the replies when the question is deleted
            //Delete all the replies where the "question_id" of replies equals to the "id" of the questions table. 
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
