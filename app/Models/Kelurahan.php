<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    public function keluargas()
    {
        return $this->hasMany(Keluarga::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
