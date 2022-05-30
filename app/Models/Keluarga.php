<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelurahan_id',
        'kd_kecamatan',
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

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }


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
            return $query;
        }
    }

    public function scopePraSejahtera($query, $cek)
    {
        if ($cek) {
            return $query->where('pra_sejahtera', 1);
        } else {
            return $query;
        }
    }

    public function scopeTidakMemilikiSumberAir($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_sumber_air', 1);
        } else {
            return $query;
        }
    }

    public function scopeTidakMemilikiJamban($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_jamban', 1);
        } else {
            return $query;
        }
    }

    public function scopeTidakMemilikiRumah($query, $cek)
    {
        if ($cek) {
            return $query->where('tidak_memiliki_rumah', 1);
        } else {
            return $query;
        }
    }

    public function scopePendidikanDibawah($query, $cek)
    {
        if ($cek) {
            return $query->where('pendidikan_ibu_dibawah_sltp', 1);
        } else {
            return $query;
        }
    }

    public function scopeTerlaluMuda($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_muda', 1);
        } else {
            return $query;
        }
    }

    public function scopeTerlaluTua($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_tua', 1);
        } else {
            return $query;
        }
    }

    public function scopeTerlaluDekat($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_dekat', 1);
        } else {
            return $query;
        }
    }

    public function scopeTerlaluBanyak($query, $cek)
    {
        if ($cek) {
            return $query->where('terlalu_banyak', 1);
        } else {
            return $query;
        }
    }

    public function scopeKbrStunting($query, $cek)
    {
        if ($cek) {
            return $query->where('kbr_stunting', 1);
        } else {
            return $query;
        }
    }

    public function scopeWhereProvince($query, $id)
    {
        if ($id == null || $id == '') {
            return $query;
        }

        return $query->whereHas('kelurahan', function ($query) use ($id) {
            $query->whereHas('kecamatan', function ($query) use ($id) {
                $query->whereHas('kabupaten', function ($query) use ($id) {
                    $query->where('provinsi_id', $id);
                });
            });
        });
    }

    public function scopeWhereDistrict($query, $id)
    {
        if ($id == null || $id == '') {
            return $query;
        }

        return $query->whereHas('kelurahan', function ($query) use ($id) {
            $query->whereHas('kecamatan', function ($query) use ($id) {
                $query->where('kabupaten_id', $id);
            });
        });
    }

    public function scopeWhereSubDistrict($query, $id)
    {
        if ($id == null || $id == '') {
            return $query;
        }

        return $query->whereHas('kelurahan', function ($query) use ($id) {
            $query->where('kecamatan_id', $id);
        });
    }

    public function scopeSearchKelurahan($query, $nama)
    {
        return $query->whereHas('kelurahan', function ($query) use ($nama) {
            $query->where('nama', 'like', '%' . $nama . '%');
        });
    }
}
