<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function warga()
    {
        return $this->hasMany(Warga::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'jenis_id');
    }
}
