<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WdTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wd_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id');
            $table->foreignId('user_id');
            $table->foreignId('member_id');
            $table->string('invoice_code', 100);
            $table->dateTime('transaction_date');
            $table->dateTime('transaction_deadline');
            $table->dateTime('transaction_paydate');
            $table->double('transaction_paid');
            $table->double('transaction_paid_extra');
            $table->double('transaction_discount');
            $table->double('transaction_tax');
            $table->enum('status', ['NEW', 'PROCESSING', 'FINISHED', 'PULLED']);
            $table->enum('paid_status', ['PAID', 'UNPAID']);
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
        Schema::dropIfExists('wd_transactions');
    }
}
