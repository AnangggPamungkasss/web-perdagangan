<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $table ='komoditas';

    protected $fillable = ['nama_komoditas', 'satuan', 'pasar_id', 'tanggal', 'harga'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }
    
}
