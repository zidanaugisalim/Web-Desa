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
            // Jadwal Vitamin A dan Cacing
            $table->date('jadwal_vitamin_a_1')->nullable()->after('vitamin_a');
            $table->date('jadwal_vitamin_a_2')->nullable()->after('jadwal_vitamin_a_1');
            $table->date('jadwal_cacing_1')->nullable()->after('jadwal_vitamin_a_2');
            $table->date('jadwal_cacing_2')->nullable()->after('jadwal_cacing_1');
            
            // Status pemberian
            $table->boolean('vitamin_a_1_diberikan')->default(false)->after('jadwal_cacing_2');
            $table->boolean('vitamin_a_2_diberikan')->default(false)->after('vitamin_a_1_diberikan');
            $table->boolean('cacing_1_diberikan')->default(false)->after('vitamin_a_2_diberikan');
            $table->boolean('cacing_2_diberikan')->default(false)->after('cacing_1_diberikan');
            
            // Pelacakan kehadiran
            $table->json('kehadiran_posyandu')->nullable()->after('cacing_2_diberikan');
            
            // Status gizi untuk grafik
            $table->enum('status_gizi', ['Normal', 'Gizi Kurang', 'Gizi Buruk', 'Gizi Lebih'])->nullable()->after('kehadiran_posyandu');
            
            // Field untuk otomatisasi arsip
            $table->boolean('is_archived')->default(false)->after('status_gizi');
            $table->date('archived_at')->nullable()->after('is_archived');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            $table->dropColumn([
                'jadwal_vitamin_a_1',
                'jadwal_vitamin_a_2', 
                'jadwal_cacing_1',
                'jadwal_cacing_2',
                'vitamin_a_1_diberikan',
                'vitamin_a_2_diberikan',
                'cacing_1_diberikan',
                'cacing_2_diberikan',
                'kehadiran_posyandu',
                'status_gizi',
                'is_archived',
                'archived_at'
            ]);
        });
    }
};
