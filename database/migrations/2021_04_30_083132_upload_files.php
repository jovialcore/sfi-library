<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table){

            $table->id();
            $table->string('name');
            $table->string('file_type')->nullable();
            $table->text('path')->nullable();
            $table->integer('size')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
                    //if you delete a category, all child is deleted
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');

    }
}
