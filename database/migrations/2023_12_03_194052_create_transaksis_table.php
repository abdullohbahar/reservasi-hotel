<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_transaksi');
            $table->string('metode_pembayaran');
            $table->string('total_biaya');
            $table->foreignId('reservasi_id')->nullable()->constrained('reservasis')->nullOnDelete();
            $table->foreignId('tamu_id')->nullable()->constrained('tamus')->nullOnDelete();
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
        Schema::dropIfExists('transaksis');
    }
}
