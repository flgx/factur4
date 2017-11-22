<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Attachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('attachable_id');
            $table->string('attachable_type');
            $table->string('filename');
            $table->string('mimetype');
            $table->integer('size');
            $table->string('url_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachments');
    }
}
