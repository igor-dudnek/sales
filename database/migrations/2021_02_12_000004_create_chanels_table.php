<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChanelsTable extends Migration
{
    public function up()
    {
        Schema::create('chanels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('chanelurl')->unique();
            $table->boolean('status')->default(0)->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
