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
        Schema::create('services', function (Blueprint $table) {
            $table->integer('id', true)->primary(true)->unsigned();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
