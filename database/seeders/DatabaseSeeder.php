<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Rubrik Pertemuan 6 (Challenge Nilai A+):
     * 1. Akun Demo Penguji: 1 user khusus dosenpbkk@its.ac.id dengan data portofolio siap pakai.
     * 2. Akun Mahasiswa Authoritative: Mikail Ibrahim Hakim (5025241046@student.its.ac.id).
     * 3. Penyiraman Otomatis Masif: 15 user mahasiswa acak, di mana setiap user otomatis memiliki 2 project dummy.
     */
    public function run(): void
    {
        // 1. Akun Demo Dosen Penguji PBKK
        $dosen = User::factory()->create([
            'name' => 'Dosen Penguji PBKK',
            'email' => 'dosenpbkk@its.ac.id',
            'password' => Hash::make('password'),
        ]);

        Project::create([
            'judul' => 'Evaluasi Otomasi Agentic AI Kurikulum Teknik Informatika',
            'deskripsi' => 'Platform pengujian komparatif performa model otonom lokal (Ollama) dalam asistensi penilaian tugas pemrograman berbasis kerangka kerja dan tinjauan keamanan kode.',
            'tema_agent' => 'Ollama',
            'api_key_secure' => 'sk-pbkk-evaluator-' . hash('sha256', 'dosen-secret-key-1'),
            'user_id' => $dosen->id,
        ]);

        Project::create([
            'judul' => 'Sistem Verifikasi Kebijakan Multi-Agent ITS',
            'deskripsi' => 'Orkestrasi agen otonom untuk validasi kepatuhan tata kelola akademik institusi menggunakan LLM terstruktur dan deterministic necessity gate.',
            'tema_agent' => 'Local LLM',
            'api_key_secure' => 'sk-pbkk-evaluator-' . hash('sha256', 'dosen-secret-key-2'),
            'user_id' => $dosen->id,
        ]);

        // 2. Akun Mahasiswa Authoritative (Mikail Ibrahim Hakim)
        $student = User::factory()->create([
            'name' => 'Mikail Ibrahim Hakim',
            'email' => '5025241046@student.its.ac.id',
            'password' => Hash::make('password'),
        ]);

        Project::create([
            'judul' => 'Security Agent Harness: Local-First Investigation System',
            'deskripsi' => 'Local-first agentic security investigation harness yang menggabungkan perencanaan hipotesis berbasis model lokal (probabilistic brain) dengan runtime eksekusi berpagar kebijakan deterministik (deterministic spine).',
            'tema_agent' => 'Local LLM',
            'api_key_secure' => 'sk-pbkk-student-' . hash('sha256', 'student-secure-key-1'),
            'user_id' => $student->id,
        ]);

        Project::create([
            'judul' => 'Ollama-Powered Immutable Evidence & Forensic Replay',
            'deskripsi' => 'Subsistem pencatatan artefak investigasi insiden keamanan yang dapat di-replay secara deterministik untuk verifikasi evaluasi ground truth tanpa risiko kebocoran data.',
            'tema_agent' => 'Ollama',
            'api_key_secure' => 'sk-pbkk-student-' . hash('sha256', 'student-secure-key-2'),
            'user_id' => $student->id,
        ]);

        // 3. Batch Seeding: 15 mahasiswa acak, masing-masing memiliki 2 project dummy (Total: 30 project dummy)
        User::factory()
            ->count(15)
            ->create()
            ->each(function (User $user) {
                Project::factory()
                    ->count(2)
                    ->create([
                        'user_id' => $user->id,
                    ]);
            });
    }
}
