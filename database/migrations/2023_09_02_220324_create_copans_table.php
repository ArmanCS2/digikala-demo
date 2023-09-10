<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copans', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('amount');
            $table->tinyInteger('amount_type')->default(0)->comment('0 => % , 1 => price');
            $table->unsignedBigInteger('discount_ceiling')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0 => many users one time , 1 => one user one time');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
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
        Schema::dropIfExists('copans');
    }
}
