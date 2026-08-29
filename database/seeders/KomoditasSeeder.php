<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data komoditas tanpa pasar_id
        DB::table('komoditas')->insert([
            ['nama_komoditas' => 'Beras', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Daging Ayam Ras', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Telur Ayam Ras', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Bawang Merah', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Cabai Merah', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Cabai Rawit', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Minyak Goreng', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Gula Pasir', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Bawang Putih', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Daging Sapi', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Tepung Terigu', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Udang', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Ikan Kembung', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Mie Instant', 'satuan' => 'bungkus'],
            ['nama_komoditas' => 'Tempe', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Tahu Mentah', 'satuan' => 'kg'],
            ['nama_komoditas' => 'Pisang Gapi', 'satuan' => 'sisr'],
            ['nama_komoditas' => 'Susu Bubuk', 'satuan' => '400 gr'],
            ['nama_komoditas' => 'Susu Kemasan', 'satuan' => '400 gr'],
            ['nama_komoditas' => 'Jeruk', 'satuan' => 'kg'],
        ]);
       
    }
}
