<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->longText('gallery')->nullable();
            $table->decimal('pre_rub')->default(0);
            $table->decimal('pre_usd')->default(0);
            $table->decimal('price');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_popular')->nullable();
            $table->boolean('is_onsale')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
