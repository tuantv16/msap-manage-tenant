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
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id', true)->primary(true)->unsigned();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable()->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
