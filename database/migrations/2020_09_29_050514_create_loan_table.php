<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_type');
            $table->string('loan_date');
            $table->integer('loan_no');
            $table->string('loan_holder');
            $table->integer('member_id');
            $table->string('loan_reason');
            $table->integer('loan_amt');
            $table->integer('loan_profit');
            $table->integer('loan_duration');
            $table->string('loan_g_1');
            $table->string('loan_g_2');
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
        Schema::dropIfExists('loan');
    }
}
