<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('material')->nullable();
            $table->text('size')->nullable();
            $table->text('feature_1')->nullable();
            $table->text('feature_2')->nullable();
            $table->text('feature_3')->nullable();
            $table->text('feature_4')->nullable();
            $table->text('feature_5')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
