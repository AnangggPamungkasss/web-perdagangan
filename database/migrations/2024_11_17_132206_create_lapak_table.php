<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lapak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lapak');
            $table->string('nomor_lapak');
            $table->string('nama_penyewa');
            $table->unsignedBigInteger('pasar_id');
            $table->foreign('pasar_id')->references('id')->on('pasar')->onDelete('cascade');
            $table->string('status');
            $table->string('masa_berlaku');
            $table->float('luas');
            $table->integer('retribusi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapak');
    }
};
