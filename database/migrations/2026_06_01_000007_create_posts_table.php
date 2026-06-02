<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Заголовок статьи
            $table->text('content'); // Текст статьи
            $table->string('image')->nullable(); // Путь к фотографии статьи (может быть пустым)
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('posts'); }
};