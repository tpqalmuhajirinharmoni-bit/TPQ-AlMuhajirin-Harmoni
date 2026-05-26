<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->nullable()->after('name');
            $table->string('birth_place')->nullable()->after('nickname');
            $table->date('birth_date')->nullable()->after('birth_place');
            $table->unsignedTinyInteger('age')->nullable()->after('birth_date');
            $table->text('address')->nullable()->after('phone');
            $table->foreignId('guardian_id')->nullable()->constrained('users')->nullOnDelete()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['guardian_id']);
            $table->dropColumn(['guardian_id', 'address', 'age', 'birth_date', 'birth_place', 'nickname']);
        });
    }
};
