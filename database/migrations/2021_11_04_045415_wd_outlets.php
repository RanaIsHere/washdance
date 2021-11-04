<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WdOutlets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wd_outlets', function (Blueprint $table) {
            $table->id();
            $table->string('outlet_name', 100);
            $table->text('outlet_address');
            $table->string('outlet_phone', 32);
            $table->enum('status', ['BANKRUPT', 'CLOSED', 'ACTIVE']);
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
        Schema::dropIfExists('wd_outlets');
    }
}
