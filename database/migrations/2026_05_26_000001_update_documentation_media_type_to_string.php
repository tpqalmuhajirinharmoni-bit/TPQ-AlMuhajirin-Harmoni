<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentation_media', function (Blueprint $table) {
            $table->string('type', 20)->default('image')->change();
        });
    }

    public function down(): void
    {
        Schema::table('documentation_media', function (Blueprint $table) {
            $table->enum('type', ['image', 'video'])->default('image')->change();
        });
    }
};
