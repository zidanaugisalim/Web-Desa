<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\PengukuranImt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anak = Auth::user()->anak()->latest()->paginate(10);
        return view('anak.index', compact('anak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug: Log the raw request data
        \Log::info('Raw request data:', $request->all());
        
        // Debug: Check if 'nama' exists in the request
        if (!$request->has('nama')) {
            \Log::error('Nama field is missing from the request');
        } else {
            \Log::info('Nama value:', ['nama' => $request->input('nama')]);
        }
        
        // Debug: Log all input fields
        \Log::info('All input fields:', $request->keys());
        
        $validated = $request->validate([
            // Data Pribadi
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|size:16|unique:anak,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            
            // Alamat
            'alamat' => 'required|string',
            'rt_rw' => 'required|string|max:20',
            'kode_pos' => 'required|string|max:10',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'puskesmas' => 'required|string|max:100',
            'tanggal_pengukuran' => 'required|date',
            'posyandu' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15',
            
            // Data Kesehatan
            'berat_badan' => 'required|numeric|min:0.1|max:200', // Berat badan dalam kg (0.1kg - 200kg)
            'tinggi_badan' => 'required|numeric|min:30|max:300', // Tinggi badan dalam cm (30cm - 300cm)
            'posisi_pengukuran' => 'required|in:Berdiri,Tidur',
            'lingkar_kepala' => 'nullable|numeric|min:20|max:100', // Lingkar kepala dalam cm (20cm - 100cm)
            'lingkar_lengan' => 'nullable|numeric|min:5|max:50', // Lingkar lengan dalam cm (5cm - 50cm)
            'asi_eksklusif' => 'required|boolean',
            'mpasi' => 'required|boolean',
            'mpasi_jenis' => 'required_if:mpasi,1|string|max:100|nullable',
            'vitamin_a' => 'required|boolean',
            'pmt' => 'required|boolean',
            'pmt_jenis' => 'required_if:pmt,1|string|max:100|nullable',
            
            // Upload File
            'foto_anak' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('foto_anak')) {
            $fotoAnak = $request->file('foto_anak');
            $fotoAnakName = 'anak_' . time() . '_' . Str::random(10) . '.' . $fotoAnak->getClientOriginalExtension();
            $fotoAnak->storeAs('public/foto_anak', $fotoAnakName);
            $validated['foto_anak'] = 'foto_anak/' . $fotoAnakName;
        }

        if ($request->hasFile('foto_kk')) {
            $fotoKK = $request->file('foto_kk');
            $fotoKKName = 'kk_' . time() . '_' . Str::random(10) . '.' . $fotoKK->getClientOriginalExtension();
            $fotoKK->storeAs('public/foto_kk', $fotoKKName);
            $validated['foto_kk'] = 'foto_kk/' . $fotoKKName;
        }

        // Tambahkan user_id
        $validated['user_id'] = Auth::id();

        // Map field names for database compatibility
        // Copy 'nama' to 'nama_anak' for Stunting model compatibility
        if (isset($validated['nama'])) {
            $validated['nama_anak'] = $validated['nama'];
        }
        
        // Copy 'nama_ayah' and 'nama_ibu' to 'nama_orangtua' for Stunting model compatibility
        if (isset($validated['nama_ayah']) && isset($validated['nama_ibu'])) {
            $validated['nama_orangtua'] = $validated['nama_ayah'] . ' / ' . $validated['nama_ibu'];
        }
        
        // Copy 'rt_rw' to 'rt' and 'rw' for Stunting model compatibility
        if (isset($validated['rt_rw'])) {
            $rtRw = explode('/', $validated['rt_rw']);
            $validated['rt'] = isset($rtRw[0]) ? trim($rtRw[0]) : '';
            $validated['rw'] = isset($rtRw[1]) ? trim($rtRw[1]) : '';
        }

        // Simpan data
        Anak::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Data anak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $this->authorize('view', $anak);
        
        // Ambil data pengukuran IMT untuk grafik
        $pengukuranImt = $anak->pengukuranImt()->orderBy('tanggal_pengukuran', 'asc')->get();
        
        return view('anak.show', compact('anak', 'pengukuranImt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        $this->authorize('update', $anak);
        return view('anak.edit', compact('anak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak)
    {
        $this->authorize('update', $anak);
        
        // Debug: Log the incoming request data
        \Log::info('Update request data:', $request->all());
        \Log::info('Current anak data before update:', $anak->toArray());
        \Log::info('Form has alamat field: ' . ($request->has('alamat') ? 'Yes' : 'No'));
        \Log::info('Form data raw: ' . $request->getContent());
        \Log::info('Form alamat value: ' . $request->input('alamat', 'NOT FOUND'));

        try {
            // Convert radio button values to boolean
            $request->merge([
                'asi_eksklusif' => $request->input('asi_eksklusif') === '1',
                'mpasi' => $request->input('mpasi') === '1',
                'vitamin_a' => $request->input('vitamin_a') === '1',
                'pmt' => $request->input('pmt') === '1',
            ]);

            $rules = [
                // Data Pribadi
                'nama' => 'required|string|max:100',
                'nik' => 'required|string|size:16|unique:anak,nik,' . $anak->id,
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_ayah' => 'required|string|max:100',
                'nama_ibu' => 'required|string|max:100',
                
                // Alamat
                'alamat' => 'required|string',
                'rt_rw' => 'required|string|max:20',
                'kode_pos' => 'required|string|max:10',
                'kecamatan' => 'required|string|max:100',
                'kabupaten' => 'required|string|max:100',
                'provinsi' => 'required|string|max:100',
                'desa' => 'required|string|max:100',
                'puskesmas' => 'required|string|max:100',
                'tanggal_pengukuran' => 'required|date',
                'posyandu' => 'required|string|max:100',
                'no_telepon' => 'required|string|max:15',
                
                // Data Kesehatan
                'berat_badan' => 'required|numeric|min:0.1|max:200',
                'tinggi_badan' => 'required|numeric|min:30|max:300',
                'posisi_pengukuran' => 'required|in:Berdiri,Tidur',
                'lingkar_kepala' => 'nullable|numeric|min:20|max:100',
                'lingkar_lengan' => 'nullable|numeric|min:5|max:50',
                'asi_eksklusif' => 'required|boolean',
                'mpasi' => 'required|boolean',
                'mpasi_jenis' => 'required_if:mpasi,1|string|max:100|nullable',
                'vitamin_a' => 'required|boolean',
                'pmt' => 'required|boolean',
                'pmt_jenis' => 'required_if:pmt,1|string|max:100|nullable',
            ];
            
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                \Log::error('Validation failed:', $validator->errors()->toArray());
                return back()->withErrors($validator)->withInput();
            }
            
            $validated = $validator->validated();
            
            // Handle MP-ASI and PMT jenis fields
            if (!$validated['mpasi']) {
                $validated['mpasi_jenis'] = null;
            }
            
            if (!$validated['pmt']) {
                $validated['pmt_jenis'] = null;
            }

            // Debug: Log validated data
            \Log::info('Validated data:', $validated);
            
            // Debug: Log alamat field specifically
            \Log::info('Alamat field in validated data: ' . (isset($validated['alamat']) ? $validated['alamat'] : 'NOT FOUND'));
            
            // Update data
            foreach ($validated as $key => $value) {
                \Log::info('Setting ' . $key . ' to: ' . (is_string($value) ? $value : json_encode($value)));
                $anak->{$key} = $value;
            }
            $saved = $anak->save();
            
            // Debug: Log the update result and updated data
            \Log::info('Update result:', ['success' => $saved]);
            \Log::info('Updated anak data:', $anak->fresh()->toArray());

            if ($saved) {
                return redirect()->route('anak.show', $anak->id)
                    ->with('success', 'Data anak berhasil diperbarui');
            }
            
            return back()->with('error', 'Gagal memperbarui data anak');
            
        } catch (\Exception $e) {
            \Log::error('Error updating anak data: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $this->authorize('delete', $anak);

        // Hapus file foto jika ada
        if ($anak->foto_anak) {
            Storage::delete('public/' . $anak->foto_anak);
        }
        if ($anak->foto_kk) {
            Storage::delete('public/' . $anak->foto_kk);
        }

        $anak->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Data anak berhasil dihapus');
    }
    
    /**
     * Simpan pengukuran IMT baru
     */
    public function storePengukuranImt(Request $request, Anak $anak)
    {
        $this->authorize('view', $anak);
        
        $validated = $request->validate([
            'berat_badan' => 'required|numeric|min:0.1|max:200',
            'tinggi_badan' => 'required|numeric|min:30|max:300',
            'tanggal_pengukuran' => 'required|date',
            'catatan' => 'nullable|string|max:500'
        ]);
        
        // Hitung IMT
        $imt = PengukuranImt::hitungIMT($validated['berat_badan'], $validated['tinggi_badan']);
        
        // Hitung umur anak dalam bulan untuk kategori IMT
        $umurBulan = Carbon::parse($anak->tanggal_lahir)->diffInMonths(Carbon::parse($validated['tanggal_pengukuran']));
        
        // Tentukan kategori IMT
        $kategoriImt = PengukuranImt::kategoriIMT($imt, $umurBulan, $anak->jenis_kelamin);
        
        // Simpan data pengukuran
        PengukuranImt::create([
            'anak_id' => $anak->id,
            'berat_badan' => $validated['berat_badan'],
            'tinggi_badan' => $validated['tinggi_badan'],
            'imt' => $imt,
            'kategori_imt' => $kategoriImt,
            'tanggal_pengukuran' => $validated['tanggal_pengukuran'],
            'catatan' => $validated['catatan']
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data pengukuran IMT berhasil disimpan',
            'data' => [
                'imt' => $imt,
                'kategori_imt' => $kategoriImt,
                'tanggal_pengukuran' => $validated['tanggal_pengukuran']
            ]
        ]);
    }
    
    /**
     * Ambil data pengukuran IMT untuk grafik
     */
    public function getPengukuranImtData(Anak $anak)
    {
        $this->authorize('view', $anak);
        
        $pengukuranImt = $anak->pengukuranImt()
            ->orderBy('tanggal_pengukuran', 'asc')
            ->get()
            ->map(function($item) {
                return [
                    'tanggal' => $item->tanggal_pengukuran->format('Y-m-d'),
                    'imt' => $item->imt,
                    'kategori' => $item->kategori_imt,
                    'berat_badan' => $item->berat_badan,
                    'tinggi_badan' => $item->tinggi_badan
                ];
            });
            
        return response()->json($pengukuranImt);
    }
}
