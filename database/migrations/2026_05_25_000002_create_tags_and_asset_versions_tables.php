<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('documentation_media_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documentation_media_id')->constrained('documentation_media')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('documentation_media_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documentation_media_id')->constrained('documentation_media')->onDelete('cascade');
            $table->string('file_path');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentation_media_versions');
        Schema::dropIfExists('documentation_media_tag');
        Schema::dropIfExists('tags');
    }
};
