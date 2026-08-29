<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapak extends Model
{
    use HasFactory;

    protected $table ='lapak';

    protected $fillable = [
        'nama_lapak', 'nomor_lapak', 'nama_penyewa', 'pasar_id', 'status', 'masa_berlaku', 'luas', 'retribusi'
    ];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class, 'pasar_id');
    }
}
