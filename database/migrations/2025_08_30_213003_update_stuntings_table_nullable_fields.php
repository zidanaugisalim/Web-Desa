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
            // Make required fields nullable to prevent insert errors
            $table->string('nama_anak')->nullable()->change();
            $table->string('nik', 16)->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->change();
            $table->string('nama_orangtua')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->string('rt')->nullable()->change();
            $table->string('rw')->nullable()->change();
            $table->decimal('berat_badan', 5, 2)->nullable()->change();
            $table->decimal('tinggi_badan', 5, 2)->nullable()->change();
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->change();
            $table->enum('status_stunting', ['Tidak Stunting', 'Stunting Ringan', 'Stunting Sedang', 'Stunting Berat'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stuntings', function (Blueprint $table) {
            // Revert fields back to not nullable
            $table->string('nama_anak')->nullable(false)->change();
            $table->string('nik', 16)->nullable(false)->change();
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false)->change();
            $table->string('nama_orangtua')->nullable(false)->change();
            $table->string('alamat')->nullable(false)->change();
            $table->string('rt')->nullable(false)->change();
            $table->string('rw')->nullable(false)->change();
            $table->decimal('berat_badan', 5, 2)->nullable(false)->change();
            $table->decimal('tinggi_badan', 5, 2)->nullable(false)->change();
            $table->decimal('lingkar_kepala', 5, 2)->nullable(false)->change();
            $table->enum('status_stunting', ['Tidak Stunting', 'Stunting Ringan', 'Stunting Sedang', 'Stunting Berat'])->nullable(false)->change();
        });
    }
};
