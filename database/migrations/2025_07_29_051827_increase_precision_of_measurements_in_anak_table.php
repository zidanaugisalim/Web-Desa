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
            // Increase precision for measurement columns
            $table->decimal('berat_badan', 10, 2)->change();
            $table->decimal('tinggi_badan', 10, 2)->change();
            $table->decimal('lingkar_kepala', 10, 2)->nullable()->change();
            $table->decimal('lingkar_lengan', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {
            // Revert back to original precision
            $table->decimal('berat_badan', 5, 2)->change();
            $table->decimal('tinggi_badan', 5, 2)->change();
            $table->decimal('lingkar_kepala', 5, 2)->nullable()->change();
            $table->decimal('lingkar_lengan', 5, 2)->nullable()->change();
        });
    }
};
