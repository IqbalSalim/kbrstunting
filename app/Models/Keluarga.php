<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelurahan_id',
        'kd_kelurahan',
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

    public function scopeBaduta($query, $baduta)
    {


        if ($baduta) {
            return $query->where('baduta', 1);
        } else {
            return $query;
        }
    }

    public function scopeBalita($query, $balita)
    {
        if ($balita) {
            return $query->where('balita', 1);
        } else {
            return $query;
        }
    }

    public function scopePusHamil($query, $pusHamil)
    {
        if ($pusHamil) {
            return $query->where('pus_hamil', 1);
        } else {
            return $query;
        }
    }

    public function scopePus($query, $pus)
    {
        if ($pus) {
            return $query->where('pus', 1);
        } else {
            return $query;
        }
    }

    public function scopeAnakTidakSekolah($query, $anakTidakSekolah)
    {
        if ($anakTidakSekolah) {
            return $query->where('anak_tidak_sekolah', 1);
        } else {
            return $query;
        }
    }

    public function scopeTidakMemilikiSumberPenghasilan($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_sumber_penghasilan', 1);
        } else {
            return $query;
        }
    }

    public function scopeLantaiTanah($query, $cek)
    {
        if ($cek) {
            return $query->where('lantai_tanah', 1);
        } else {
            return $query;
        }
    }

    public function scopeTidakMakan($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_makan', 1);
        } else {
            return $query->orWhere('tidak_makan', 1);
        }
    }

    public function scopePraSejahtera($query, $cek)
    {
        if ($cek) {
            return $query->where('pra_sejahtera', 1);
        } else {
            return $query->orWhere('pra_sejahtera', 1);
        }
    }

    public function scopeTidakMemilikiSumberAir($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_sumber_air', 1);
        } else {
            return $query->orWhere('tidak_memiliki_sumber_air', 1);
        }
    }

    public function scopeTidakMemilikiJamban($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_jamban', 1);
        } else {
            return $query->orWhere('tidak_memiliki_jamban', 1);
        }
    }

    public function scopeTidakMemilikiRumah($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_rumah', 1);
        } else {
            return $query->orWhere('tidak_memiliki_rumah', 1);
        }
    }

    public function scopePendidikanDibawah($query, $cek)
    {
        if ($cek) {
            return $query->where('pendidikan_ibu_dibawah_sltp', 1);
        } else {
            return $query->orWhere('pendidikan_ibu_dibawah_sltp', 1);
        }
    }

    public function scopeTerlaluMuda($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_muda', 1);
        } else {
            return $query->orWhere('terlalu_muda', 1);
        }
    }

    public function scopeTerlaluTua($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_tua', 1);
        } else {
            return $query->orWhere('terlalu_tua', 1);
        }
    }

    public function scopeTerlaluDekat($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_dekat', 1);
        } else {
            return $query->orWhere('terlalu_dekat', 1);
        }
    }

    public function scopeTerlaluBanyak($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_banyak', 1);
        } else {
            return $query->orWhere('terlalu_banyak', 1);
        }
    }

    public function scopeKbrStunting($query, $cek)
    {
        if ($cek) {
            return $query->where('kbr_stunting', 1);
        } else {
            return $query->orWhere('kbr_stunting', 1);
        }
    }
}
