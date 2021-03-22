<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AlterAddColumnToParkingLots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parking_lots', function (Blueprint $table) {
            $table->enum('status',['ocupado','libre'])->default('libre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parking_lots', function (Blueprint $table) {
           $table->dropColumn('status');
        });
    }
}
