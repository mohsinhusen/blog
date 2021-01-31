<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnhandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onhand', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->double('outward_amount');
            $table->double('inward_amount');
            $table->double('retrun_amount');
            $table->double('remaining_amount');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onhand');
    }
}
