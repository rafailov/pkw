<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class About extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->increments('about_id');
            $table->string('about_title');
            $table->text('about_slogan');
            $table->text('about_textOne');
            $table->text('about_textTwo');
            $table->string('about_imageOne');
            $table->string('about_imageTwo');
            $table->string('about_telephone');
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
        //
    }
}
