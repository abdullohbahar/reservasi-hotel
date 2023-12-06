<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKamarIdToReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->foreignId('kamar_id')->after('tipe_kamar_id')->nullable()->constrained('kamars')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            //
        });
    }
}
