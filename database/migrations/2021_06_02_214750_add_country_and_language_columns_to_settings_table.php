<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryAndLanguageColumnsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('supported_countries')->nullable();
            $table->unsignedBigInteger('default_country_id')->nullable();
            $table->string('supported_locales')->nullable();
            $table->string('default_locale')->nullable();
            $table->unsignedBigInteger('timezone_id')->nullable();
            $table->foreign('default_country_id')->references('id')->on('countries');
            $table->foreign('timezone_id')->references('id')->on('timezones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
