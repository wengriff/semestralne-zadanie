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
        Schema::create('math_problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('latex_file_id');
            $table->string('identifier');
            $table->text('problem_text');
            $table->text('solution_text');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('latex_file_id')
                  ->references('id')
                  ->on('latex_files')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('math_problems');
    }
};
