<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FileCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //this is for the user the categories and also for the user that created the categories
            Schema::create('categories', function(Blueprint $table){

                $table->increments('id');
                //user that created catgories
                $table->unsignedBigInteger('user_id')->nullable();
                
                $table->string('name');
                $table->timestamps();

                //so I am saying here that the user_id on this file_categories table is acting as a reference or it is referring to the "id" column in "users" table
                $table->foreign('user_id')->references('id')->on('users');
                //I should have said that when the category is deleted, the user value id should be deleted too but no...so i will leave ti like that above
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');

    }
}
