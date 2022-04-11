<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan_id',
        'kabupaten_id',
        'nama',
    ];

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
