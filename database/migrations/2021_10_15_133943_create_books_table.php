<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_session')->useCurrent();
            $table->datetime('end_session')->nullable();
            $table->integer('bill')->default(0);
            $table->enum('payment', ['paid', 'unpaid'])->default('unpaid');
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('bay_id');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('bay_id')->references('id')->on('bays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
