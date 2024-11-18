<?php

namespace App\Models\Manajemen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manajemen extends Model
{
    use HasFactory;
    protected $table = 'manajemens';
    protected $fillable = ['nama_user','username','password','email','role'];
}
