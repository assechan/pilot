<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',19,2);
            $table->string('description', 200)->nullable();
            $table->integer('so_head_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('so_head_id')->references('id')->on('consignee_service_order_headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
