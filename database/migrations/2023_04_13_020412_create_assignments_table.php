<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('assignment_date');
            $table->integer('status')->comment('1: Sudah Dikumpulkan, 2: Sudah Dinilai');
            $table->integer('type')->comment('1: Tepat Waktu, 2: Terlambat');
            $table->integer('score')->nullable();
            $table->text('note')->nullable();
            $table->string('file');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
