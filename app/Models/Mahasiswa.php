<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table='mahasiswa';
    protected $primaryKey='nama_mahasiswa';
    protected $fillable = [
        'nama_mahasiswa',
        'email',
        'NIM',
        'prodi',
        'jurusan',
        'angkatan',
        'telp'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
