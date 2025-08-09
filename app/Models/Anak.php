<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'anak';

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
        'desa',
        'puskesmas',
        'tanggal_pengukuran',
        'posyandu',
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
        'user_id',
        'catatan_khusus'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pengukuran' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'lingkar_kepala' => 'decimal:2',
        'lingkar_lengan' => 'decimal:2',
        'asi_eksklusif' => 'boolean',
        'mpasi' => 'boolean',
        'vitamin_a' => 'boolean',
        'pmt' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}