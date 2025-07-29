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
            // Rename columns
            $table->renameColumn('nama_lengkap', 'nama');
            $table->renameColumn('nama_orangtua', 'nama_ayah');
            
            // Add new columns
            $table->string('nama_ibu')->after('nama_ayah');
            $table->decimal('berat_badan', 5, 2)->after('alamat');
            $table->decimal('tinggi_badan', 5, 2)->after('berat_badan');
            $table->enum('posisi_pengukuran', ['Berdiri', 'Tidur'])->after('tinggi_badan');
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->after('posisi_pengukuran');
            $table->decimal('lingkar_lengan', 5, 2)->nullable()->after('lingkar_kepala');
            $table->boolean('asi_eksklusif')->default(false)->after('lingkar_lengan');
            $table->boolean('mpasi')->default(false)->after('asi_eksklusif');
            $table->string('mpasi_jenis', 100)->nullable()->after('mpasi');
            $table->boolean('vitamin_a')->default(false)->after('mpasi_jenis');
            $table->boolean('pmt')->default(false)->after('vitamin_a');
            $table->string('pmt_jenis', 100)->nullable()->after('pmt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            // Reverse the changes
            $table->renameColumn('nama', 'nama_lengkap');
            $table->renameColumn('nama_ayah', 'nama_orangtua');
            
            // Drop the new columns
            $table->dropColumn([
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
            ]);
        });
    }
};
