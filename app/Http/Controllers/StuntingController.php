<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stuntings = Stunting::latest()->paginate(10);
        return view('stuntings.index', compact('stuntings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stuntings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:100',
            'nik' => 'required|string|size:16|unique:stuntings,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_orangtua' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'lingkar_kepala' => 'required|numeric|min:0',
            'status_stunting' => 'required|in:Tidak Stunting,Stunting Ringan,Stunting Sedang,Stunting Berat',
            'keterangan' => 'nullable|string',
        ]);

        Stunting::create($validated);

        return redirect()->route('stuntings.index')
            ->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stunting $stunting)
    {
        return view('stuntings.show', compact('stunting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stunting $stunting)
    {
        return view('stuntings.edit', compact('stunting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stunting $stunting)
    {
        try {
            // Log the incoming request data
            \Log::info('Stunting Update Request:', $request->all());
            \Log::info('Current Stunting Data:', $stunting->toArray());

            $validated = $request->validate([
                'nama_anak' => 'required|string|max:100',
                'nik' => 'required|string|size:16|unique:stuntings,nik,' . $stunting->id,
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'nama_orangtua' => 'required|string|max:100',
                'alamat' => 'required|string',
                'rt' => 'required|string|max:3',
                'rw' => 'required|string|max:3',
                'berat_badan' => 'required|numeric|min:0',
                'tinggi_badan' => 'required|numeric|min:0',
                'lingkar_kepala' => 'required|numeric|min:0',
                'status_stunting' => 'required|in:Tidak Stunting,Stunting Ringan,Stunting Sedang,Stunting Berat',
                'keterangan' => 'nullable|string',
            ]);

            // Log the validated data
            \Log::info('Validated Data:', $validated);

            // Update the model using fill and save
            $stunting->fill($validated);
            $saved = $stunting->save();

            // Log the update result
            \Log::info('Update Result:', [
                'success' => $saved,
                'updated_data' => $stunting->fresh()->toArray()
            ]);

            if (!$saved) {
                throw new \Exception('Gagal menyimpan perubahan ke database');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Data anak berhasil diperbarui.');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating stunting data: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            // Redirect back with error message
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stunting $stunting)
    {
        $stunting->delete();

        return redirect()->route('stuntings.index')
            ->with('success', 'Data anak berhasil dihapus.');
    }
}
