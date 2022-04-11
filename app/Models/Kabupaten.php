<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'provinsi_id',
        'kd_kabupaten',
        'nama',
    ];

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
