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
        Schema::create('task_index', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('admin_check')->default(0)->comment('Проверенно администратором');
            $table->string('name');
            $table->string('email');
            $table->text('description')->comment('Текст задачи');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_index');
    }
};
