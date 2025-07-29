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
            // Check if columns exist before renaming
            if (Schema::hasColumn('anak', 'nama_lengkap')) {
                $table->renameColumn('nama_lengkap', 'nama');
            }
            
            if (Schema::hasColumn('anak', 'nama_orangtua')) {
                $table->renameColumn('nama_orangtua', 'nama_ayah');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            // Reverse the column renames
            if (Schema::hasColumn('anak', 'nama')) {
                $table->renameColumn('nama', 'nama_lengkap');
            }
            
            if (Schema::hasColumn('anak', 'nama_ayah')) {
                $table->renameColumn('nama_ayah', 'nama_orangtua');
            }
        });
    }
};
