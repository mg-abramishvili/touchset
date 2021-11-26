<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderOrderItemTable extends Migration
{
    public function up()
    {
        Schema::create('order_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('order_item_id');
        });
    }

    public function down()
    {
        //
    }
}
