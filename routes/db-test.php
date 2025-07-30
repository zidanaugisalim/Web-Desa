<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return [
            'status' => 'Connected',
            'database' => DB::connection()->getDatabaseName(),
            'driver' => DB::connection()->getDriverName(),
        ];
    } catch (\Exception $e) {
        return [
            'status' => 'Not connected',
            'error' => $e->getMessage()
        ];
    }
});
