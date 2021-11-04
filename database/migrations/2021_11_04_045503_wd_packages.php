<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WdPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wd_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id');
            $table->enum('package_type', ['CURTAIN', 'BLANKET', 'BED_COVER', 'SPECIAL_SHIRT', 'SUIT', 'STANDARD']);
            $table->string('package_name', 100);
            $table->double('pacckage_price');
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
        Schema::dropIfExists('wd_packages');
    }
}
