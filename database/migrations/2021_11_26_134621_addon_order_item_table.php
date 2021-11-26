<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddonOrderItemTable extends Migration
{
    public function up()
    {
        Schema::create('addon_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('addon_id');
            $table->integer('order_item_id');
            $table->decimal('price');
        });
    }

    public function down()
    {
        //
    }
}
