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
        Schema::create('assignment_sets', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->timestamp('starting_date');
            $table->timestamp('deadline');
            $table->integer('points');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignment_sets');
    }
};
