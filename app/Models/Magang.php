<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;
    protected $table='magang';
    protected $primaryKey='no_magang';
    protected $fillable = [
        'nama_mahasiswa',
        'NIM',
        'instansi_magang',
        'nilai_akhir',
        'file',
        'berkas'
    ];
    public $timestamps = false;
}
