<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table='dosen';
    protected $primaryKey='nama_dosen';
    protected $fillable = [
        'nama_dosen',
        'email',
        'NIP',
        'jurusan',
        'telp'
    ];
    public $timestamps = false;
    public $incrementing = false; //mengatasi agar tidak auto increment meskipun primary key bukan integer
}
