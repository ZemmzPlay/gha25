<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbstractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('phone_code');
            $table->string('author_institution');
            $table->string('city');
            $table->string('country');
            $table->string('abstract_title');
            $table->string('category');
            $table->string('purpose_statment');
            $table->longText('purpose_statment_text');
            $table->longText('methods');
            $table->longText('results');
            $table->longText('conclusion');
            $table->string('file');
            $table->string('question1', 3);
            $table->string('question2', 3);
            $table->string('question3', 3);
            $table->string('question4', 3);
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
        Schema::dropIfExists('abstracts');
    }
}
