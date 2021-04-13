<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('message_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id', 'message_id_fk_3177299')->references('id')->on('messages')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_3177299')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
