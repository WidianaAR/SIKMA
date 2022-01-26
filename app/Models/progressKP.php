<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class progressKP extends Model
{
    use HasFactory;
    protected $table='progress_kp';
    protected $primaryKey='no_progress';
    protected $fillable = [
        'no_kp',
        'tanggal',
        'keterangan',
        'komentar',
        'nilai',
        'file',
    ];
    public $timestamps = false;
}
