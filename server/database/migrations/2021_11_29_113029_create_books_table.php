<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("author")->nullable();
            $table->string("isbn")->nullable();
            $table->string("cover")->nullable();
            $table->integer("rating")->nullable();
            $table->bigInteger("genre_id")->unsigned()->nullable();
            $table->foreign("genre_id")->references("id")->on("genres");
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
        Schema::dropIfExists('books');
    }
}
