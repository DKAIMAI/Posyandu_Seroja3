<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('balita_orangtua', function (Blueprint $table) {
            $table->id('balita_id');
            $table->integer('anak_ke');
            $table->string('nomor_kk', 20);
            $table->string('nik_balita', 16);
            $table->string('nama_balita', 50);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->float('bbl'); // Berat Badan Lahir
            $table->float('pbl'); // Panjang Badan Lahir
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balita_orangtua');
    }
};
