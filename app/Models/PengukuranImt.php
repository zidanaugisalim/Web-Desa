<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengukuranImt extends Model
{
    protected $table = 'pengukuran_imt';
    
    protected $fillable = [
        'anak_id',
        'berat_badan',
        'tinggi_badan',
        'imt',
        'kategori_imt',
        'tanggal_pengukuran',
        'catatan'
    ];
    
    protected $casts = [
        'tanggal_pengukuran' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'imt' => 'decimal:2'
    ];
    
    public function anak(): BelongsTo
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
    
    // Method untuk menghitung IMT
    public static function hitungIMT($beratBadan, $tinggiBadan)
    {
        // Konversi tinggi dari cm ke meter
        $tinggiMeter = $tinggiBadan / 100;
        
        // Hitung IMT = berat (kg) / (tinggi (m))^2
        $imt = $beratBadan / ($tinggiMeter * $tinggiMeter);
        
        return round($imt, 2);
    }
    
    // Method untuk menentukan kategori IMT berdasarkan umur anak
    public static function kategoriIMT($imt, $umurBulan, $jenisKelamin)
    {
        // Kategori IMT untuk anak berdasarkan WHO Child Growth Standards
        // Ini adalah implementasi sederhana, untuk akurasi lebih baik perlu menggunakan z-score
        
        if ($imt < 17) {
            return 'Sangat Kurus';
        } elseif ($imt >= 17 && $imt < 18.5) {
            return 'Kurus';
        } elseif ($imt >= 18.5 && $imt < 25) {
            return 'Normal';
        } elseif ($imt >= 25 && $imt < 30) {
            return 'Gemuk';
        } else {
            return 'Obesitas';
        }
    }
}
