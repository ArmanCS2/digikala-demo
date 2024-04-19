<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('introduction');
            $table->string('slug')->unique()->nullable();
            $table->text('image');
            $table->decimal('weight',10,2)->nullable();
            $table->decimal('length',10,1)->nullable();
            $table->decimal('width',10,1)->nullable();
            $table->decimal('height',10,1)->nullable();
            $table->decimal('price',20,3);
            $table->text('tags')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('marketable')->default(1);
            $table->bigInteger('sold_number')->default(0);
            $table->bigInteger('frozen_number')->default(0);
            $table->bigInteger('marketable_number')->default(0);
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
