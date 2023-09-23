<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailBiayaInKeuangans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keuangans', function (Blueprint $table) {
            $table->decimal('biaya_harian', 15, 2);
            $table->decimal('biaya_penginapan', 15, 2);
            $table->decimal('biaya_transport', 15, 2);
            $table->decimal('biaya_representasi', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keuangans', function (Blueprint $table) {
            //
        });
    }
}
