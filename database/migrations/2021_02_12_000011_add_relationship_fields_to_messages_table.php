<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('chanel_id')->nullable();
            $table->foreign('chanel_id', 'chanel_fk_3177285')->references('id')->on('chanels');
        });
    }
}
