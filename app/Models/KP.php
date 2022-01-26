<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KP extends Model
{
    use HasFactory;
    protected $table='kp';
    protected $primaryKey='no_kp';
    protected $fillable = [
        'nama_mahasiswa',
        'nama_dosen',
        'saran_dospem',
        'NIM',
        'judul_kp',
        'instansi_kp',
        'semhas',
        'nilai_akhir',
        'file',
        'berkas'
    ];
    public $timestamps = false;
}
