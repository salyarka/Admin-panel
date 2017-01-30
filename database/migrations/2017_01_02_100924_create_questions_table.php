<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('created_at');
            $table->date('updated_at');
            $table->integer('topic_id')->unsigned();
            $table->boolean('status');
            $table->string('author_name');
            $table->string('text');
            $table->string('answer')->nullable();
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('topic_id')
                  ->references('id')->on('topics')
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
        Schema::drop('questions');
    }
}
