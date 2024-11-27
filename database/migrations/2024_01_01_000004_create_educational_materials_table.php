<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('educational_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('category', ['terbaru', 'terpopuler', 'pemanasan_global', 'energi_terbarukan', 'konservasi']);
            $table->string('image');
            $table->enum('difficulty', ['mudah', 'sedang', 'sulit']);
            $table->text('description');
            $table->foreignId('created_by')->constrained('users');
            $table->integer('views')->default(0);
            $table->string('file_path')->nullable();
            $table->timestamps();
            $table->index('category');
            $table->index('views');
        });
    }

    public function down()
    {
        Schema::dropIfExists('educational_materials');
    }
}; 