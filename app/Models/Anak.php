<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anak extends Model
{
    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'anak';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'alamat',
        'rt_rw',
        'kode_pos',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'no_telepon',
        'berat_badan',
        'tinggi_badan',
        'posisi_pengukuran',
        'lingkar_kepala',
        'lingkar_lengan',
        'asi_eksklusif',
        'mpasi',
        'mpasi_jenis',
        'vitamin_a',
        'pmt',
        'pmt_jenis',
        'foto_anak',
        'foto_kk',
        'user_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
