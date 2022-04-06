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
            $table->foreignId('kelurahan_id')->constrained('kelurahans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kd_kelurahan');
            $table->string('kode_keluarga');
            $table->string('nik_kk');
            $table->string('nama_kk');
            $table->integer('baduta');
            $table->integer('balita');
            $table->integer('pus');
            $table->integer('pus_hamil');
            $table->integer('anak_tidak_sekolah');
            $table->integer('tidak_memiliki_sumber_penghasilan');
            $table->integer('lantai_tanah');
            $table->integer('tidak_makan');
            $table->integer('pra_sejahtera');
            $table->integer('tidak_memiliki_sumber_air');
            $table->integer('tidak_memiliki_jamban');
            $table->integer('tidak_memiliki_rumah');
            $table->integer('pendidikan_ibu_dibawah_sltp');
            $table->integer('terlalu_muda');
            $table->integer('terlalu_tua');
            $table->integer('terlalu_dekat');
            $table->integer('terlalu_banyak');
            $table->integer('kbr_stunting');
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
