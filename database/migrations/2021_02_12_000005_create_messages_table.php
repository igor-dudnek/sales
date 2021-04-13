<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->longText('text');
            $table->string('contactt')->nullable();
            $table->string('contacts')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
