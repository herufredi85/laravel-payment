<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('idpayment');
            $table->string('iduserref');
            $table->string('codetransaction');
            $table->text('payment_reference');
            $table->Integer('totalpayment');
            $table->string('datetransaction')->nullable();
            $table->smallInteger('status');
            $table->dateTime("datepayment")->nullable();
        });

        DB::table('payment')->insert([
            ['iduserref'=>2,'totalpayment'=>5000,'codetransaction' => 'TRANS001', 'payment_reference' => "PAY001",'status' => '0','datetransaction' => '2023-08-16 14:01:01'],
            ['iduserref'=>3,'totalpayment'=>6000,'codetransaction' => 'TRANS002', 'payment_reference' => "PAY002",'status' => '0','datetransaction' => '2023-08-16 14:01:01'],
          
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
