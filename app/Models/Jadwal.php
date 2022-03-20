<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
