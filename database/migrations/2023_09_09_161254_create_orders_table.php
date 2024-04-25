<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('address_object')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('payment_object')->nullable();
            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->foreignId('delivery_id')->nullable()->constrained('delivery')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('delivery_object')->nullable();
            $table->decimal('delivery_amount',20,3)->nullable();
            $table->tinyInteger('delivery_status')->default(0)->comment('0 => storage , 1 => sending , 2 => sent , 3 => delivered  ');
            $table->timestamp('delivery_date')->nullable();
            $table->foreignId('copan_id')->nullable()->constrained('copans')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('copan_object')->nullable();
            $table->decimal('copan_discount_amount',20,3)->nullable();
            $table->foreignId('common_discount_id')->nullable()->constrained('common_discount')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('common_discount_object')->nullable();
            $table->decimal('common_discount_amount',20,3)->nullable();
            $table->decimal('final_price',20,3)->nullable();
            $table->decimal('final_discount',20,3)->nullable();
            $table->decimal('total_price',20,3)->nullable();
            $table->tinyInteger('order_status')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('tracking_code')->nullable();
            $table->text('optional_1')->nullable();
            $table->text('optional_2')->nullable();
            $table->text('optional_3')->nullable();
            $table->text('optional_4')->nullable();
            $table->text('optional_5')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
