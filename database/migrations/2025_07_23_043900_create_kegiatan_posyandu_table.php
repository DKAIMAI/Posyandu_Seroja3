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
        Schema::create('kegiatan_posyandu', function (Blueprint $table) {
            $table->id('kegiatan_id');
            $table->date('tgl_ukur');
            $table->integer('usia_bulan');
            $table->float('bb_balita');
            $table->float('tb_balita');
            $table->float('lila_balita');
            $table->string('status_kms', 10)->nullable();
            $table->string('ntt_balita', 10)->nullable();

            $table->float('lingkar_pinggang_ibu')->nullable();
            $table->float('bb_ibu')->nullable();
            $table->float('tb_ibu')->nullable();
            $table->enum('jenis_kb', ['Suntik', 'Pil', 'Implan', 'IUD', 'Tidak'])->nullable();
            $table->enum('vitamin_a', ['Merah', 'Biru', 'Tidak Diberikan'])->nullable();
            $table->enum('obat_cacing', ['Diberikan', 'Tidak'])->nullable();

            $table->unsignedBigInteger('pendaftaran_id');
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran_posyandu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_posyandu');
    }
};
