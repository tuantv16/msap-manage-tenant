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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->integer('id')->primary(true)->autoIncrement()->unsigned();
            $table->string('name')->unique();
            $table->json('infor')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable()->unsigned();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
