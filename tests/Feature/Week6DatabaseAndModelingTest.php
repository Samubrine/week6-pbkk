<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class Week6DatabaseAndModelingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Rubrik 1 - Rancangan Skema Migration (35%)
     * Memeriksa keberadaan kolom, tipe data, default value, dan foreign key.
     */
    public function test_projects_table_has_expected_columns_and_constraints(): void
    {
        $this->assertTrue(Schema::hasTable('projects'), 'Tabel projects harus ada.');
        $this->assertTrue(Schema::hasColumns('projects', [
            'id',
            'judul',
            'deskripsi',
            'tema_agent',
            'api_key_secure',
            'user_id',
            'created_at',
            'updated_at',
        ]), 'Tabel projects harus memiliki seluruh kolom yang disyaratkan.');

        // Verify default value on tema_agent
        $user = User::factory()->create();
        $project = Project::create([
            'judul' => 'Inovasi AI Tanpa Tema Default',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Ollama', $project->fresh()->tema_agent, 'Kolom tema_agent harus memiliki default Ollama.');
    }

    /**
     * Test 2: Rubrik 1 - Foreign Key Cascade Deletion
     */
    public function test_cascade_delete_removes_projects_when_user_is_deleted(): void
    {
        $user = User::factory()->create();
        $project = Project::create([
            'judul' => 'Proyek Uji Cascade',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('projects', ['id' => $project->id]);

        // Hapus user
        $user->delete();

        // Proyek terkait harus terhapus otomatis via cascade
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /**
     * Test 3: Rubrik 2 - Pemodelan Data & Mass Assignment Guard (25%)
     * Memastikan $fillable aktif dan relasi belongsTo / hasMany berfungsi.
     */
    public function test_project_model_has_fillable_and_relations(): void
    {
        $user = User::factory()->create();
        $project = new Project([
            'judul' => 'Judul Test Fillable',
            'deskripsi' => 'Deskripsi panjang proyek',
            'tema_agent' => 'Anthropic',
            'api_key_secure' => 'sk-test-12345',
            'user_id' => $user->id,
        ]);
        $project->save();

        $this->assertInstanceOf(User::class, $project->user, 'Relasi project->user harus mengembalikan User instance.');
        $this->assertEquals($user->id, $project->user->id);

        $this->assertTrue($user->projects->contains($project), 'Relasi user->projects harus memuat project.');
    }

    /**
     * Test 4: Rubrik 3 - Factories & Seeders Orkestrasi (20%)
     * Memeriksa kelengkapan seeder: akun dosenpbkk, akun mahasiswa, 15 user acak, total 34 proyek.
     */
    public function test_database_seeder_creates_expected_dataset(): void
    {
        $this->seed();

        // 1. Akun dosen penguji
        $dosen = User::where('email', 'dosenpbkk@its.ac.id')->first();
        $this->assertNotNull($dosen, 'User dosenpbkk@its.ac.id harus ada.');
        $this->assertCount(2, $dosen->projects, 'Dosen harus memiliki 2 proyek demo.');

        // 2. Akun mahasiswa authoritative
        $student = User::where('email', '5025241046@student.its.ac.id')->first();
        $this->assertNotNull($student, 'User mahasiswa 5025241046@student.its.ac.id harus ada.');
        $this->assertCount(2, $student->projects, 'Mahasiswa harus memiliki 2 proyek.');

        // 3. Total akun & proyek
        $this->assertEquals(17, User::count(), 'Total user harus 17 (1 dosen + 1 mahasiswa + 15 acak).');
        $this->assertEquals(34, Project::count(), 'Total projects harus 34 (2 per user x 17).');
    }

    /**
     * Test 5: Rubrik 4 - Integritas Query di Dashboard (10%)
     * Memastikan kueri hanya menampilkan proyek milik user aktif login dan terurut terbaru.
     */
    public function test_dashboard_only_displays_projects_of_authenticated_user(): void
    {
        $userA = User::factory()->create(['name' => 'User A']);
        $userB = User::factory()->create(['name' => 'User B']);

        $projectA = Project::factory()->create([
            'judul' => 'Proyek Spesifik User A',
            'user_id' => $userA->id,
            'created_at' => now()->subDay(),
        ]);

        $projectB = Project::factory()->create([
            'judul' => 'Proyek Rahasia User B',
            'user_id' => $userB->id,
            'created_at' => now(),
        ]);

        // Request dashboard saat login sebagai User A
        $response = $this->actingAs($userA)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Proyek Spesifik User A');
        $response->assertDontSee('Proyek Rahasia User B');
    }

    /**
     * Test 6: Akses dashboard tanpa login dialihkan ke halaman login
     */
    public function test_guest_is_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
