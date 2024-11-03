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
        Schema::create('tenants', function (Blueprint $table) {
            $table->integer('id', true)->primary(true)->unsigned();
            $table->string('company_name', 50)->unique();
            $table->string('company_name_kana', 50)->unique();
            $table->string('company_name_abbreviation', 50)->unique();
            $table->string('domain', 250)->unique();
            $table->string('email', 150)->nullable();
            $table->text('address')->nullable();
            $table->string('contact', 50)->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
