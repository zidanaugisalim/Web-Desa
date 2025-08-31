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
    protected $table = 'stuntings';

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
        'is_archived',
        'archived_at'
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
        'jadwal_vitamin_a_1' => 'date',
        'jadwal_vitamin_a_2' => 'date',
        'jadwal_cacing_1' => 'date',
        'jadwal_cacing_2' => 'date',
        'vitamin_a_1_diberikan' => 'boolean',
        'vitamin_a_2_diberikan' => 'boolean',
        'cacing_1_diberikan' => 'boolean',
        'cacing_2_diberikan' => 'boolean',
        'kehadiran_posyandu' => 'json',
        'is_archived' => 'boolean',
        'archived_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
     * Arsipkan anak jika sudah berumur 5 tahun
     */
    public function arsipkanJikaBerumur5Tahun()
    {
        if ($this->isBerumur5TahunAtauLebih()) {
            $this->update([
                'is_archived' => true,
                'archived_at' => now()
            ]);
            return true;
        }
        return false;
    }

    /**
     * Arsipkan anak (method untuk command)
     */
    public function arsipkan()
    {
        $this->update([
            'is_archived' => true,
            'archived_at' => now()
        ]);
        return true;
    }

    /**
     * Cek apakah anak sudah berumur 5 tahun
     */
    public function isBerumur5TahunAtauLebih()
    {
        $umur = $this->umur;
        return $umur !== null && $umur >= 5;
    }

    /**
     * Get umur anak dalam tahun
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        
        try {
            $birthDate = \Carbon\Carbon::parse($this->tanggal_lahir);
            
            // Validasi tanggal lahir tidak boleh di masa depan
            if ($birthDate->isFuture()) {
                return null;
            }
            
            // Validasi tanggal lahir tidak boleh terlalu lama (misal > 100 tahun)
            if ($birthDate->diffInYears(now()) > 100) {
                return null;
            }
            
            return $birthDate->diffInYears(now());
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get status gizi berdasarkan IMT
     */
    public function getStatusGiziAttribute()
    {
        if (!$this->berat_badan || !$this->tinggi_badan || $this->tinggi_badan <= 0) {
            return null;
        }
        
        $tinggi_m = $this->tinggi_badan / 100;
        $imt = $this->berat_badan / ($tinggi_m * $tinggi_m);
        
        // Kategori IMT berdasarkan KMS (Kartu Menuju Sehat)
        if ($imt < 17) {
            return 'Gizi Buruk';
        } elseif ($imt >= 17 && $imt < 18.5) {
            return 'Gizi Kurang';
        } elseif ($imt >= 18.5 && $imt < 25) {
            return 'Normal';
        } else {
            return 'Gizi Lebih';
        }
    }
    
    /**
     * Relationship dengan pengukuran IMT
     */
    public function pengukuranImt()
    {
        return $this->hasMany(PengukuranImt::class, 'anak_id');
    }
    
    /**
     * Get pengukuran IMT terbaru
     */
    public function pengukuranImtTerbaru()
    {
        return $this->hasOne(PengukuranImt::class, 'anak_id')->latest('tanggal_pengukuran');
    }

}