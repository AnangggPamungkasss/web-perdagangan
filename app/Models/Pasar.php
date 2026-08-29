<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory;

    protected $table = 'pasar'; 

    protected $fillable = ['nama_pasar', 'alamat', 'latitude', 'longitude'];

    public function lapak()
    {
        return $this->hasMany(Lapak::class, 'pasar_id');
    }

    public function komoditas()
    {
        return $this->hasMany(Komoditas::class, 'pasar_id');
    }
}
