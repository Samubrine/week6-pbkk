<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel 2 - projects:
     * Berisi rancangan ide proposal Agentic AI (judul, deskripsi, tema_agent, api_key_secure, user_id).
     * Constraint:
     * - foreignId('user_id') terikat ke users.id secara cascade
     * - nullable() pada kolom deskripsi & api_key_secure
     * - default('Ollama') pada kolom tema_agent
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->string('tema_agent', 100)->default('Ollama');
            $table->string('api_key_secure', 255)->nullable();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
