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
            Schema::create('mesjids', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis',['Pemasukan','Pengeluaran']);
            $table->enum('kategori',['Infaq','Sedekah','Zakat','Pembayaran Air','Pembayaran Listrik','Pembelian Barang','Lainnya']);
            $table->bigInteger('jumlah');
            $table->string('deskripsi');
            $table->string('foto');
            $table->bigInteger('saldo_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesjids');
    }
};
