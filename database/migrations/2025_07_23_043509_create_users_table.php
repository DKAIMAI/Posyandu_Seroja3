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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nik_ortu', 20)->unique();
            $table->string('nama_ortu', 50);
            $table->string('password');
            $table->enum('role', ['kader', 'orangtua']);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
