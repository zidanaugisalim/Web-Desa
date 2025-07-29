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
        // Drop the existing table if it exists
        Schema::dropIfExists('anak');
        
        // Create the table with the correct structure
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            
            // Alamat
            $table->text('alamat');
            $table->string('rt_rw');
            $table->string('kode_pos');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('no_telepon');
            
            // Data Kesehatan
            $table->decimal('berat_badan', 8, 2);
            $table->decimal('tinggi_badan', 8, 2);
            $table->enum('posisi_pengukuran', ['Berdiri', 'Tidur']);
            $table->decimal('lingkar_kepala', 8, 2)->nullable();
            $table->decimal('lingkar_lengan', 8, 2)->nullable();
            $table->boolean('asi_eksklusif')->default(false);
            $table->boolean('mpasi')->default(false);
            $table->string('mpasi_jenis')->nullable();
            $table->boolean('vitamin_a')->default(false);
            $table->boolean('pmt')->default(false);
            $table->string('pmt_jenis')->nullable();
            
            // File uploads
            $table->string('foto_anak')->nullable();
            $table->string('foto_kk')->nullable();
            $table->text('catatan_khusus')->nullable();
            
            // Foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
