<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foreignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function($table) {
            $table->foreign('price_service_id')->references('service_id')->on('services');
        });

        Schema::table('applications', function($table) {
            $table->foreign('app_career')->references('career_id')->on('careers');
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
