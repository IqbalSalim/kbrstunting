<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('kode_keluarga');
            $table->string('nik_kk');
            $table->string('nama_kk');
            $table->char('baduta', 1);
            $table->char('balita', 1);
            $table->char('pus', 1);
            $table->char('pus_hamil', 1);
            $table->char('anak_tidak_sekolah', 1);
            $table->char('tidak_memiliki_sumber_penghasilan', 1);
            $table->char('lantai_tanah', 1);
            $table->char('tidak_makan', 1);
            $table->char('pra_sejahtera', 1);
            $table->char('tidak_memiliki_sumber_air', 1);
            $table->char('tidak_memiliki_jamban', 1);
            $table->char('tidak_memiliki_rumah', 1);
            $table->char('pendidikan_ibu_dibawah_sltp', 1);
            $table->char('terlalu_muda', 1);
            $table->char('terlalu_tua', 1);
            $table->char('terlalu_dekat', 1);
            $table->char('terlalu_banyak', 1);
            $table->char('kbr_stunting', 1);
            $table->string('rt')->nullable();
            $table->string('dusun_rw')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
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
        Schema::dropIfExists('keluargas');
    }
}
