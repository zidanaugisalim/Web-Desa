<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GrafikController extends Controller
{
    /**
     * Tampilkan grafik status gizi per login
     */
    public function statusGizi()
    {
        $user = auth()->user();
        
        // Data untuk grafik status gizi berdasarkan user login
        $statusGizi = Anak::active()
            ->where('user_id', $user->id)
            ->select('status_gizi', DB::raw('count(*) as total'))
            ->groupBy('status_gizi')
            ->get();
            
        return view('grafik.status-gizi', compact('statusGizi'));
    }
    
    /**
     * Tampilkan grafik KMS bulanan untuk anak tertentu
     */
    public function kmsBulanan(Request $request)
    {
        $anakId = $request->input('anak_id');
        $tahun = $request->input('tahun', date('Y'));
        
        // Jika tidak ada anak_id, ambil anak pertama atau redirect ke halaman pilih anak
        if (!$anakId) {
            $firstAnak = Anak::active()->first();
            if ($firstAnak) {
                $anakId = $firstAnak->id;
            } else {
                return redirect()->route('anak.index')->with('error', 'Belum ada data anak. Silakan tambahkan data anak terlebih dahulu.');
            }
        }
        
        $anak = Anak::find($anakId);
        if (!$anak) {
            return redirect()->route('anak.index')->with('error', 'Data anak tidak ditemukan.');
        }
        
        // Ambil data pengukuran bulanan (simulasi - dalam implementasi nyata bisa dari tabel terpisah)
        $pengukuranBulanan = collect();
        
        // Generate data KMS untuk 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            
            // Simulasi data - dalam implementasi nyata ambil dari database
            $beratBadan = $anak->berat_badan + (rand(-5, 5) / 10);
            $tinggiBadan = $anak->tinggi_badan + (rand(-2, 2) / 10);
            
            $pengukuranBulanan->push([
                'bulan' => $bulan->format('M Y'),
                'berat_badan' => round($beratBadan, 1),
                'tinggi_badan' => round($tinggiBadan, 1),
                'umur_bulan' => $anak->tanggal_lahir->diffInMonths($bulan)
            ]);
        }
        
        return view('grafik.kms-bulanan', compact('anak', 'pengukuranBulanan', 'anakId', 'tahun'));
    }
    
    /**
     * API endpoint untuk data grafik status gizi
     */
    public function apiStatusGizi()
    {
        $user = auth()->user();
        
        $data = Anak::active()
            ->where('user_id', $user->id)
            ->select('status_gizi', DB::raw('count(*) as total'))
            ->groupBy('status_gizi')
            ->get()
            ->map(function($item) {
                return [
                    'label' => $item->status_gizi ?? 'Belum Diperiksa',
                    'value' => $item->total
                ];
            });
            
        return response()->json($data);
    }
    
    /**
     * API untuk mendapatkan data anak yang perlu perhatian khusus
     */
    public function apiAnakPerluPerhatian()
    {
        $anakPerluPerhatian = Anak::active()
            ->where(function($query) {
                $query->where('status_gizi', 'Gizi Buruk')
                      ->orWhere('status_gizi', 'Gizi Kurang')
                      ->orWhere('vitamin_a_1_diberikan', false)
                      ->orWhere('vitamin_a_2_diberikan', false)
                      ->orWhere('cacing_1_diberikan', false)
                      ->orWhere('cacing_2_diberikan', false);
            })
            ->get()
            ->map(function($anak) {
                return [
                    'id' => $anak->id,
                    'nama' => $anak->nama,
                    'status_gizi' => $anak->status_gizi,
                    'perlu_vitamin_a' => !$anak->vitamin_a_1_diberikan || !$anak->vitamin_a_2_diberikan,
                    'perlu_cacing' => !$anak->cacing_1_diberikan || !$anak->cacing_2_diberikan
                ];
            });
            
        return response()->json($anakPerluPerhatian);
    }
    
    /**
     * API endpoint untuk data KMS bulanan
     */
    public function apiKmsBulanan(Request $request)
    {
        $anakId = $request->get('anak_id');
        $tahun = $request->get('tahun', date('Y'));
        
        if (!$anakId) {
            return response()->json(['error' => 'Anak ID diperlukan'], 400);
        }
        
        $anak = Anak::findOrFail($anakId);
        
        // Generate data KMS untuk 12 bulan terakhir
        $data = collect();
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            
            // Simulasi data - dalam implementasi nyata ambil dari database
            $beratBadan = $anak->berat_badan + (rand(-5, 5) / 10);
            $tinggiBadan = $anak->tinggi_badan + (rand(-2, 2) / 10);
            
            $data->push([
                'bulan' => $bulan->format('M Y'),
                'berat_badan' => round($beratBadan, 1),
                'tinggi_badan' => round($tinggiBadan, 1),
                'umur_bulan' => $anak->tanggal_lahir->diffInMonths($bulan)
            ]);
        }
        
        return response()->json($data);
    }
    
    /**
     * Tampilkan dashboard grafik utama
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistik umum
        $totalAnak = Anak::active()->where('user_id', $user->id)->count();
        $giziBuruk = Anak::active()->where('user_id', $user->id)->where('status_gizi', 'Gizi Buruk')->count();
        $perluVitaminA = Anak::active()->where('user_id', $user->id)
            ->where(function($q) {
                $q->where('vitamin_a_1_diberikan', false)
                  ->orWhere('vitamin_a_2_diberikan', false);
            })->count();
        $perluCacing = Anak::active()->where('user_id', $user->id)
            ->where(function($q) {
                $q->where('cacing_1_diberikan', false)
                  ->orWhere('cacing_2_diberikan', false);
            })->count();
            
        return view('grafik.dashboard', compact('totalAnak', 'giziBuruk', 'perluVitaminA', 'perluCacing'));
    }
}
