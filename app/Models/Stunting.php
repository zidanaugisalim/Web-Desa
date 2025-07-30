<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stunting extends Model
{
    protected $fillable = [
        'nama_anak',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_orangtua',
        'alamat',
        'rt',
        'rw',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'status_stunting',
        'keterangan'
    ];

    protected $dates = [
        'tanggal_lahir',
        'created_at',
        'updated_at'
    ];
}
