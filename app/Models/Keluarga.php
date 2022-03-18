<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'kode_keluarga',
        'nik_kk',
        'nama_kk',
        'baduta',
        'balita',
        'pus',
        'pus_hamil',
        'anak_tidak_sekolah',
        'tidak_memiliki_sumber_penghasilan',
        'lantai_tanah',
        'tidak_makan',
        'pra_sejahtera',
        'tidak_memiliki_sumber_air',
        'tidak_memiliki_jamban',
        'tidak_memiliki_rumah',
        'pendidikan_ibu_dibawah_sltp',
        'terlalu_muda',
        'terlalu_tua',
        'terlalu_dekat',
        'terlalu_banyak',
        'kbr_stunting',
        'rt',
        'dusun_rw',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
    ];
}
