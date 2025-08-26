<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('year_published')->nullable();
            $table->string('isbn')->nullable();
            $table->string('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('stock');
            $table->string('file_path')->nullable();
            $table->enum('status', ['available','borrowed', 'inactive']);
            $table->boolean('is_recommended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
