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
        Schema::create('math_problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_set_id');
            $table->text('problem_statement');
            $table->text('solution');
            $table->string('image_path');
            $table->text('equation');
            $table->timestamps();

            $table->foreign('assignment_set_id')->references('id')->on('assignment_sets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('math_problems');
    }
};
