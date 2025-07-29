<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            // Rename columns if they exist
            if (Schema::hasColumn('anak', 'nama_lengkap')) {
                $table->renameColumn('nama_lengkap', 'nama');
            }
            if (Schema::hasColumn('anak', 'nama_orangtua')) {
                $table->renameColumn('nama_orangtua', 'nama_ayah');
            }
            
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('anak', 'nama_ibu')) {
                $table->string('nama_ibu')->after('nama_ayah');
            }
            if (!Schema::hasColumn('anak', 'berat_badan')) {
                $table->decimal('berat_badan', 8, 2)->after('no_telepon');
            }
            if (!Schema::hasColumn('anak', 'tinggi_badan')) {
                $table->decimal('tinggi_badan', 8, 2)->after('berat_badan');
            }
            if (!Schema::hasColumn('anak', 'posisi_pengukuran')) {
                $table->enum('posisi_pengukuran', ['Berdiri', 'Tidur'])->after('tinggi_badan');
            }
            if (!Schema::hasColumn('anak', 'lingkar_kepala')) {
                $table->decimal('lingkar_kepala', 8, 2)->nullable()->after('posisi_pengukuran');
            }
            if (!Schema::hasColumn('anak', 'lingkar_lengan')) {
                $table->decimal('lingkar_lengan', 8, 2)->nullable()->after('lingkar_kepala');
            }
            if (!Schema::hasColumn('anak', 'asi_eksklusif')) {
                $table->boolean('asi_eksklusif')->default(false)->after('lingkar_lengan');
            }
            if (!Schema::hasColumn('anak', 'mpasi')) {
                $table->boolean('mpasi')->default(false)->after('asi_eksklusif');
            }
            if (!Schema::hasColumn('anak', 'mpasi_jenis')) {
                $table->string('mpasi_jenis')->nullable()->after('mpasi');
            }
            if (!Schema::hasColumn('anak', 'vitamin_a')) {
                $table->boolean('vitamin_a')->default(false)->after('mpasi_jenis');
            }
            if (!Schema::hasColumn('anak', 'pmt')) {
                $table->boolean('pmt')->default(false)->after('vitamin_a');
            }
            if (!Schema::hasColumn('anak', 'pmt_jenis')) {
                $table->string('pmt_jenis')->nullable()->after('pmt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            // Revert column renames
            if (Schema::hasColumn('anak', 'nama')) {
                $table->renameColumn('nama', 'nama_lengkap');
            }
            if (Schema::hasColumn('anak', 'nama_ayah')) {
                $table->renameColumn('nama_ayah', 'nama_orangtua');
            }
            
            // Drop added columns
            $columnsToDrop = [
                'nama_ibu',
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
                'pmt_jenis'
            ];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('anak', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
