<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddonProductTable extends Migration
{
    public function up()
    {
        Schema::create('addon_product', function (Blueprint $table) {
            $table->id();
            $table->integer('addon_id');
            $table->integer('product_id');
            $table->decimal('price');
        });
    }

    public function down()
    {
        //
    }
}
