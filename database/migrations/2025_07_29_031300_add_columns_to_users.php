<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    public function up()
    {
        // Tambahkan kolom username jika belum ada
        if (!Schema::hasColumn('users', 'username')) {
            DB::statement("ALTER TABLE users ADD COLUMN username VARCHAR(255) NULL AFTER `name`;");
            DB::statement("ALTER TABLE users ADD UNIQUE INDEX users_username_unique (username);");
        }

        // Tambahkan kolom role jika belum ada
        if (!Schema::hasColumn('users', 'role')) {
            DB::statement("ALTER TABLE users ADD COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user' AFTER `username`;");
        }
    }

    public function down()
    {
        // Hapus kolom jika migrasi di-rollback
        if (Schema::hasColumn('users', 'username')) {
            DB::statement("ALTER TABLE users DROP COLUMN username;");
        }
        if (Schema::hasColumn('users', 'role')) {
            DB::statement("ALTER TABLE users DROP COLUMN role;");
        }
    }
}
