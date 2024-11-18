<?php

namespace App\Models\Mesjid;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesjid extends Model
{
    
        use HasFactory;
        protected $table = 'mesjids';
        protected $fillable = [
            'tanggal',
            'jenis',
            'kategori',
            'jumlah',
            'deskripsi',
            'foto',
            'saldo_akhir'
        ];

}
