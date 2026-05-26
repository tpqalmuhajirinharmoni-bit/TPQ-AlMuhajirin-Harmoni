<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('status')->default('present');
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->text('note')->nullable();
            $table->boolean('guardian_notified')->default(false);
            $table->timestamps();
        });

        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']);
            $table->decimal('amount', 14, 2);
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->timestamps();
        });

        Schema::create('subject_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('lesson_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('time');
            $table->string('group')->nullable();
            $table->string('activity');
            $table->timestamps();
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary')->nullable();
            $table->text('content');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('invitation_letters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('recipient_name');
            $table->string('subject');
            $table->date('event_date');
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitation_letters');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('lesson_schedules');
        Schema::dropIfExists('subject_materials');
        Schema::dropIfExists('finance_transactions');
        Schema::dropIfExists('attendances');
    }
};
