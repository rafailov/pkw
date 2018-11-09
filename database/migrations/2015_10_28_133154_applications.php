<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Applications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('app_id');
            $table->integer('app_career')->unsigned();
            $table->string('app_name');
            $table->string('app_email');
            $table->string('app_telephone');
            $table->string('app_education');
            $table->string('app_cv');
            $table->text('app_text');
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
