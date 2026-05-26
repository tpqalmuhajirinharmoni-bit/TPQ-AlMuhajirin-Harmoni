<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentation_media', function (Blueprint $table) {
            $table->string('storage_disk')->default('public')->after('file_path');
        });

        Schema::table('documentation_media_versions', function (Blueprint $table) {
            $table->string('storage_disk')->default('public')->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('documentation_media', function (Blueprint $table) {
            $table->dropColumn('storage_disk');
        });

        Schema::table('documentation_media_versions', function (Blueprint $table) {
            $table->dropColumn('storage_disk');
        });
    }
};
