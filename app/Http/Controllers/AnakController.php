<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('anak.show', compact('anak'));
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

        try {
            $validated = $request->validate([
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
            // Hapus foto lama jika ada
            if ($anak->foto_anak) {
                Storage::delete('public/' . $anak->foto_anak);
            }
            
            $fotoAnak = $request->file('foto_anak');
            $fotoAnakName = 'anak_' . time() . '_' . Str::random(10) . '.' . $fotoAnak->getClientOriginalExtension();
            $fotoAnak->storeAs('public/foto_anak', $fotoAnakName);
            $validated['foto_anak'] = 'foto_anak/' . $fotoAnakName;
        }

        if ($request->hasFile('foto_kk')) {
            // Hapus foto lama jika ada
            if ($anak->foto_kk) {
                Storage::delete('public/' . $anak->foto_kk);
            }
            
            $fotoKK = $request->file('foto_kk');
            $fotoKKName = 'kk_' . time() . '_' . Str::random(10) . '.' . $fotoKK->getClientOriginalExtension();
            $fotoKK->storeAs('public/foto_kk', $fotoKKName);
            $validated['foto_kk'] = 'foto_kk/' . $fotoKKName;
        }

            // Update data
            $anak->fill($validated);
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
}
