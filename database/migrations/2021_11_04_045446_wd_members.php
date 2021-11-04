<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WdMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wd_members', function (Blueprint $table) {
            $table->id();
            $table->string('member_name', 100);
            $table->text('member_address');
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->string('member_phone', 32);
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
        Schema::dropIfExists('wd_members');
    }
}
