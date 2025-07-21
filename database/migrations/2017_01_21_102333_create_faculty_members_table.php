<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('bio')->nullable()->default(null);
            $table->string('image_file')->nullable()->default(null);
            $table->unsignedInteger('faculty_category_id');
            $table->integer('display_order')->default(1);
            $table->foreign('faculty_category_id')->references('id')->on('faculty_categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('faculty_members');
    }
}
