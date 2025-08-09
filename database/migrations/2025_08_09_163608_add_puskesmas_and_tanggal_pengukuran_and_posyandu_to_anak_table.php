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
            $table->string('puskesmas')->default('SEWON II')->after('desa');
            $table->date('tanggal_pengukuran')->nullable()->after('puskesmas');
            $table->string('posyandu')->nullable()->after('tanggal_pengukuran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            $table->dropColumn('puskesmas');
            $table->dropColumn('tanggal_pengukuran');
            $table->dropColumn('posyandu');
        });
    }
};
