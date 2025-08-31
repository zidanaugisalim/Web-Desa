<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stunting extends Model
{
    protected $fillable = [
        'user_id',
        'nama_anak',
        'nama', // For Anak model compatibility
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_orangtua',
        'nama_ayah', // For Anak model compatibility
        'nama_ibu', // For Anak model compatibility
        'alamat',
        'rt',
        'rw',
        'rt_rw', // For Anak model compatibility
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
        'jadwal_vitamin_a_1',
        'jadwal_vitamin_a_2',
        'jadwal_cacing_1',
        'jadwal_cacing_2',
        'vitamin_a_1_diberikan',
        'vitamin_a_2_diberikan',
        'cacing_1_diberikan',
        'cacing_2_diberikan',
        'kehadiran_posyandu',
        'status_gizi',
        'status_stunting',
        'keterangan',
        'is_archived',
        'archived_at'
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_pengukuran',
        'jadwal_vitamin_a_1',
        'jadwal_vitamin_a_2',
        'jadwal_cacing_1',
        'jadwal_cacing_2',
        'archived_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'asi_eksklusif' => 'boolean',
        'mpasi' => 'boolean',
        'vitamin_a' => 'boolean',
        'pmt' => 'boolean',
        'vitamin_a_1_diberikan' => 'boolean',
        'vitamin_a_2_diberikan' => 'boolean',
        'cacing_1_diberikan' => 'boolean',
        'cacing_2_diberikan' => 'boolean',
        'is_archived' => 'boolean',
        'kehadiran_posyandu' => 'array'
    ];

    /**
     * Scope untuk anak yang aktif (belum diarsipkan)
     */
    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope untuk anak yang sudah diarsipkan
     */
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
