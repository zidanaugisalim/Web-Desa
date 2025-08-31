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
        Schema::table('stuntings', function (Blueprint $table) {
            // Add missing fields for Anak model
            $table->string('nama')->nullable()->after('id');
            $table->string('nama_ayah')->nullable()->after('nama_anak');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
            $table->string('rt_rw')->nullable()->after('alamat');
            $table->string('kode_pos')->nullable()->after('rt_rw');
            $table->string('kecamatan')->nullable()->after('kode_pos');
            $table->string('kabupaten')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kabupaten');
            $table->string('desa')->nullable()->after('provinsi');
            $table->string('puskesmas')->nullable()->after('desa');
            $table->date('tanggal_pengukuran')->nullable()->after('puskesmas');
            $table->string('posyandu')->nullable()->after('tanggal_pengukuran');
            $table->string('no_telepon')->nullable()->after('posyandu');
            $table->enum('posisi_pengukuran', ['Berdiri', 'Tidur'])->nullable()->after('tinggi_badan');
            $table->decimal('lingkar_lengan', 5, 2)->nullable()->after('lingkar_kepala');
            $table->boolean('asi_eksklusif')->default(false)->after('lingkar_lengan');
            $table->boolean('mpasi')->default(false)->after('asi_eksklusif');
            $table->string('mpasi_jenis')->nullable()->after('mpasi');
            $table->boolean('vitamin_a')->default(false)->after('mpasi_jenis');
            $table->boolean('pmt')->default(false)->after('vitamin_a');
            $table->string('pmt_jenis')->nullable()->after('pmt');
            $table->string('foto_anak')->nullable()->after('pmt_jenis');
            $table->string('foto_kk')->nullable()->after('foto_anak');
            $table->date('jadwal_vitamin_a_1')->nullable()->after('foto_kk');
            $table->date('jadwal_vitamin_a_2')->nullable()->after('jadwal_vitamin_a_1');
            $table->date('jadwal_cacing_1')->nullable()->after('jadwal_vitamin_a_2');
            $table->date('jadwal_cacing_2')->nullable()->after('jadwal_cacing_1');
            $table->boolean('vitamin_a_1_diberikan')->default(false)->after('jadwal_cacing_2');
            $table->boolean('vitamin_a_2_diberikan')->default(false)->after('vitamin_a_1_diberikan');
            $table->boolean('cacing_1_diberikan')->default(false)->after('vitamin_a_2_diberikan');
            $table->boolean('cacing_2_diberikan')->default(false)->after('cacing_1_diberikan');
            $table->json('kehadiran_posyandu')->nullable()->after('cacing_2_diberikan');
            $table->string('status_gizi')->nullable()->after('kehadiran_posyandu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stuntings', function (Blueprint $table) {
            $table->dropColumn([
                'nama', 'nama_ayah', 'nama_ibu', 'rt_rw', 'kode_pos',
                'kecamatan', 'kabupaten', 'provinsi', 'desa', 'puskesmas',
                'tanggal_pengukuran', 'posyandu', 'no_telepon', 'posisi_pengukuran',
                'lingkar_lengan', 'asi_eksklusif', 'mpasi', 'mpasi_jenis',
                'vitamin_a', 'pmt', 'pmt_jenis', 'foto_anak', 'foto_kk',
                'jadwal_vitamin_a_1', 'jadwal_vitamin_a_2', 'jadwal_cacing_1',
                'jadwal_cacing_2', 'vitamin_a_1_diberikan', 'vitamin_a_2_diberikan',
                'cacing_1_diberikan', 'cacing_2_diberikan', 'kehadiran_posyandu',
                'status_gizi'
            ]);
        });
    }
};
