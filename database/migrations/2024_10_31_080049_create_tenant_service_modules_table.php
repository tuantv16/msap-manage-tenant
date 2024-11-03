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
        Schema::create('tenant_service_modules', function (Blueprint $table) {
            $table->integer('id', true)->primary(true)->unsigned();
            $table->integer('tenant_service_id')->unsigned();
            $table->integer('module_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable()->unsigned();

            $table->foreign('tenant_service_id')->references('id')->on('tenant_services')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_service_modules');
    }
};
