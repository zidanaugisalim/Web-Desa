<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Anak;
use Carbon\Carbon;

class ArsipkanBalita extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balita:arsipkan {--dry-run : Tampilkan data yang akan diarsipkan tanpa mengarsipkan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arsipkan balita yang sudah berusia 5 tahun atau lebih untuk memudahkan pengambilan data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai proses arsip balita berusia 5 tahun...');
        
        // Cari anak yang berusia 5 tahun atau lebih dan belum diarsipkan
        $anakPerluArsip = Anak::active()
            ->whereNotNull('tanggal_lahir')
            ->get()
            ->filter(function ($anak) {
                $umur = $anak->umur;
                return $umur !== null && $umur >= 5;
            });
            
        if ($anakPerluArsip->isEmpty()) {
            $this->info('Tidak ada balita yang perlu diarsipkan.');
            return 0;
        }
        
        $this->info("Ditemukan {$anakPerluArsip->count()} balita yang perlu diarsipkan:");
        
        // Tampilkan tabel data yang akan diarsipkan
        $headers = ['ID', 'Nama', 'NIK', 'Tanggal Lahir', 'Umur (Tahun)'];
        $rows = $anakPerluArsip->map(function($anak) {
            return [
                $anak->id,
                $anak->nama,
                $anak->nik,
                $anak->tanggal_lahir ? Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') : 'N/A',
                $anak->umur ?? 'N/A'
            ];
        })->toArray();
        
        $this->table($headers, $rows);
        
        // Jika dry-run, hanya tampilkan data tanpa mengarsipkan
        if ($this->option('dry-run')) {
            $this->warn('Mode dry-run: Data di atas akan diarsipkan jika command dijalankan tanpa --dry-run');
            return 0;
        }
        
        // Konfirmasi sebelum mengarsipkan
        if (!$this->confirm('Apakah Anda yakin ingin mengarsipkan balita di atas?')) {
            $this->info('Proses arsip dibatalkan.');
            return 0;
        }
        
        // Proses arsip
        $berhasilDiarsipkan = 0;
        $gagalDiarsipkan = 0;
        
        foreach ($anakPerluArsip as $anak) {
            try {
                $anak->arsipkan();
                $berhasilDiarsipkan++;
                $this->line("✓ {$anak->nama} (ID: {$anak->id}) berhasil diarsipkan");
            } catch (\Exception $e) {
                $gagalDiarsipkan++;
                $this->error("✗ Gagal mengarsipkan {$anak->nama} (ID: {$anak->id}): {$e->getMessage()}");
            }
        }
        
        // Tampilkan ringkasan
        $this->info("\nRingkasan:");
        $this->info("- Berhasil diarsipkan: {$berhasilDiarsipkan}");
        if ($gagalDiarsipkan > 0) {
            $this->error("- Gagal diarsipkan: {$gagalDiarsipkan}");
        }
        
        $this->info('Proses arsip selesai.');
        return 0;
    }
}
