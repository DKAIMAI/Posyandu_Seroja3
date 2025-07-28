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
        Schema::create('pendaftaran_posyandu', function (Blueprint $table) {
            $table->id('pendaftaran_id');
            $table->date('tgl_daftar');
            $table->enum('status_hadir', ['hadir', 'tidak hadir']);
            $table->text('ket')->nullable();
            $table->unsignedBigInteger('balita_id');
            $table->timestamps();

            $table->foreign('balita_id')->references('balita_id')->on('balita_orangtua')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_posyandu');
    }
};
