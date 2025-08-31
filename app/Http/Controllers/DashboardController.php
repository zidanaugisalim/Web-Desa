<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Arsipkan otomatis anak yang berumur 5 tahun atau lebih
        $this->arsipkanOtomatis();
        
        // Pastikan relasi 'anak' dimuat dengan benar - hanya yang aktif dan di bawah 5 tahun
        $anak = Auth::user()->anak()
            ->active()
            ->get()
            ->filter(function ($child) {
                $umur = $child->umur;
                return $umur !== null && $umur < 5;
            })
            ->sortByDesc('created_at');
            
        // Konversi ke collection untuk pagination manual
        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $anakPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $anak->forPage($currentPage, $perPage),
            $anak->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );
            
        return view('Dashboard', compact('anakPaginated'));
    }
    
    /**
     * Arsipkan otomatis anak yang berumur 5 tahun atau lebih
     */
    private function arsipkanOtomatis()
    {
        $anakPerluArsip = Auth::user()->anak()
            ->active()
            ->get()
            ->filter(function ($child) {
                return $child->isBerumur5TahunAtauLebih();
            });
            
        foreach ($anakPerluArsip as $anak) {
            $anak->arsipkanJikaBerumur5Tahun();
        }
    }
    
    /**
     * Tampilkan halaman arsip anak yang sudah berumur 5 tahun
     */
    public function arsip()
    {
        $anakArsip = Auth::user()->anak()
            ->archived()
            ->orderBy('archived_at', 'desc')
            ->paginate(10);
            
        return view('anak.arsip', compact('anakArsip'));
    }
    
    /**
     * API endpoint untuk data grafik status gizi di dashboard
     */
    public function apiStatusGiziDashboard()
    {
        // Arsipkan otomatis anak yang berumur 5 tahun atau lebih
        $this->arsipkanOtomatis();
        
        // Ambil hanya anak aktif yang berumur di bawah 5 tahun
        $anakAktif = Auth::user()->anak()->active()->get()
            ->filter(function ($child) {
                $umur = $child->umur;
                return $umur !== null && $umur < 5;
            });
        
        $statusGizi = [
            'Gizi Baik' => 0,
            'Gizi Kurang' => 0,
            'Gizi Buruk' => 0,
            'Gizi Lebih' => 0,
            'Belum Diperiksa' => 0
        ];
        
        foreach ($anakAktif as $anak) {
            $status = $anak->status_gizi;
            if ($status) {
                // Map 'Normal' to 'Gizi Baik' untuk konsistensi dengan UI
                if ($status === 'Normal') {
                    $statusGizi['Gizi Baik']++;
                } elseif (isset($statusGizi[$status])) {
                    $statusGizi[$status]++;
                } else {
                    $statusGizi['Belum Diperiksa']++;
                }
            } else {
                $statusGizi['Belum Diperiksa']++;
            }
        }
        
        // Filter out categories with 0 values
        $filteredData = array_filter($statusGizi, function($value) {
            return $value > 0;
        });
        
        return response()->json([
            'labels' => array_keys($filteredData),
            'values' => array_values($filteredData)
        ]);
    }
}
