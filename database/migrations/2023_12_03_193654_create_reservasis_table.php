<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->date('checkin');
            $table->date('checkout');
            $table->enum('status', ['free', 'pending', 'full', 'cancel']);
            $table->string('no_booking');
            $table->foreignId('tipe_kamar_id')->nullable()->constrained('tipe_kamars')->nullOnDelete();
            $table->foreignId('tamu_id')->nullable()->constrained('tamus')->nullOnDelete();
            $table->foreignId('resepsionis_id')->nullable()->constrained('resepsionis')->nullOnDelete();
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
        Schema::dropIfExists('reservasis');
    }
}
