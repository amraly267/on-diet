<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('contact_us_email')->nullable();
            $table->string('contact_us_mobile')->nullable();
            $table->string('contact_us_phone')->nullable();
            $table->string('logo')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('snapchat_url')->nullable();
            $table->string('css_in_header')->nullable();
            $table->string('js_before_header')->nullable();
            $table->string('js_before_body')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
