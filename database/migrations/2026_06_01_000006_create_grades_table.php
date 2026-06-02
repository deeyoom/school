<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            // Связываем оценку с учеником
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // Связываем оценку с предметом
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            
            // Поля для оценок за 4 четверти (могут быть пустыми, пока учитель их не поставит)
            $table->integer('q1')->nullable(); // Чораки 1
            $table->integer('q2')->nullable(); // Чораки 2
            $table->integer('q3')->nullable(); // Чораки 3
            $table->integer('q4')->nullable(); // Чораки 4
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('grades'); }
};