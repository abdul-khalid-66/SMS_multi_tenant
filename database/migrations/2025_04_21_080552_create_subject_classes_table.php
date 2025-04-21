<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subject_classes', function (Blueprint $table) {
            $table->id(); // Creates an UNSIGNED BIGINT AUTO_INCREMENT primary key
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');
            $table->foreignId('class_id')
                ->constrained('classes')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['subject_id', 'class_id']); // Prevent duplicate combinations
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_classes');
    }
};
