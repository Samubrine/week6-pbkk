<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageControllerTest extends TestCase
{
    /**
     * Test Beranda (Home /) returns HTTP 200 and renders authoritative info.
     */
    public function test_beranda_page_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(config('academic.student.name'));
        $response->assertSee('System Architecture');
        $response->assertSee('Security Agent Harness');
        $response->assertSee('Institut Teknologi Sepuluh Nopember');
    }

    /**
     * Test /beranda alias route returns HTTP 200 and matches Beranda content.
     */
    public function test_beranda_alias_route_returns_successful_response(): void
    {
        $response = $this->get('/beranda');

        $response->assertStatus(200);
        $response->assertSee(config('academic.student.name'));
        $response->assertSee('System Architecture');
        $response->assertSee('Security Agent Harness');
    }

    /**
     * Test Bonus Challenge 2: Dynamic User Status / Greeting via query parameter.
     */
    public function test_dynamic_user_status_greeting_on_beranda(): void
    {
        // Test canonical /?user=Andi
        $responseRoot = $this->get('/?user=Andi');
        $responseRoot->assertStatus(200);
        $responseRoot->assertSee('Selamat datang,');
        $responseRoot->assertSee('Andi');
        $responseRoot->assertSee('Sapaan Pengunjung');

        // Test alias /beranda?user=Budi
        $responseAlias = $this->get('/beranda?user=Budi');
        $responseAlias->assertStatus(200);
        $responseAlias->assertSee('Selamat datang,');
        $responseAlias->assertSee('Budi');
        $responseAlias->assertSee('Sapaan Pengunjung');
    }

    /**
     * Test Profil Mahasiswa (/profil-mahasiswa) renders authoritative courses, competencies, and achievements.
     */
    public function test_profil_mahasiswa_page_returns_authoritative_student_data(): void
    {
        $response = $this->get('/profil-mahasiswa');

        $response->assertStatus(200);
        $response->assertSee(config('academic.student.name'));
        $response->assertSee('System Architecture');

        // Verify all 8 authoritative courses appear with exact spelling
        $response->assertSee('Tata Kelola Teknologi Informasi');
        $response->assertSee('Sistem Terdistribusi');
        $response->assertSee('Rekayasa Sistem Berbasis Pengetahuan');
        $response->assertSee('Pemrograman Berbasis Kerangka Kerja');
        $response->assertSee('Pemodelan dan Simulasi');
        $response->assertSee('Grafika Komputer');
        $response->assertSee('Keamanan Informasi');
        $response->assertSee('Sistem Enterprise');

        // Verify competencies appear
        $response->assertSee('Public Speaking');
        $response->assertSee('Basic Administration');
        $response->assertSee('Organization Management');
        $response->assertSee('Strategic Alignment');
        $response->assertSee('AI Implementation in Businesses / Organizations');
        $response->assertSee('Basic Agentic AI Skills');

        // Verify achievements appear factually
        $response->assertSee('Finalis GEMASTIK 2026 — Karya Tulis Ilmiah');
        $response->assertSee('Founder of KIBRA Shop');
        $response->assertSee('~2K MRR');
    }

    /**
     * Test Ide Agent (/ide-agent) renders Security Agent Harness in default light mode.
     */
    public function test_ide_agent_page_returns_security_agent_harness_in_light_mode(): void
    {
        $response = $this->get('/ide-agent');

        $response->assertStatus(200);
        $response->assertSee('Security Agent Harness');
        $response->assertSee('Local-first Agentic Security Investigation Harness');
        $response->assertSee('Probabilistic Brain');
        $response->assertSee('Deterministic Spine');
        $response->assertSee('Necessity Gate');
        $response->assertSee('Policy & Scope Enforcement');
        $response->assertSee('https://github.com/Samubrine/security-agent-harness');
        $response->assertSee('Formulir Pengusulan Ide / Masukan Kapabilitas');

        // Should not see dark mode active banner when mode is light
        $response->assertDontSee('Bonus Challenge 1: Dark Mode Aktif');
    }

    /**
     * Test Bonus Challenge 1: Dynamic Dark Mode on /ide-agent?mode=dark.
     */
    public function test_bonus_challenge_dynamic_dark_mode_on_ide_agent(): void
    {
        $response = $this->get('/ide-agent?mode=dark');

        $response->assertStatus(200);
        $response->assertSee('Bonus Challenge 1: Dark Mode Aktif');
        $response->assertSee('bg-slate-950');
        $response->assertSee('Mode Gelap Dinamis');
    }

    /**
     * Test Idea form validation when required fields are missing.
     */
    public function test_idea_form_validation_rejects_empty_submission(): void
    {
        $response = $this->post('/ide-agent', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'title', 'category', 'description']);
    }

    /**
     * Test Idea form successful submission and session flash banner.
     */
    public function test_idea_form_submission_succeeds_with_valid_data(): void
    {
        $payload = [
            'name' => 'Mikail Ibrahim Hakim',
            'email' => '5025241046@student.its.ac.id',
            'title' => 'DNS Log Correlation Capability Skill',
            'category' => 'Autonomous Agents',
            'description' => 'Menambahkan modul skill korelasi DNS log lokal yang terikat pada batasan policy harness.',
        ];

        $response = $this->post('/ide-agent', $payload);

        $response->assertStatus(302);
        $response->assertRedirect('/ide-agent');
        $response->assertSessionHas('success');

        // Follow redirect and ensure flash banner renders
        $followResponse = $this->followRedirects($response);
        $followResponse->assertStatus(200);
        $followResponse->assertSee('DNS Log Correlation Capability Skill');
        $followResponse->assertSee('berhasil dikirimkan');
    }

    /**
     * Test Idea form preserves dark mode state upon redirection.
     */
    public function test_idea_form_submission_preserves_dark_mode_parameter(): void
    {
        $payload = [
            '_mode' => 'dark',
            'name' => 'Mikail Ibrahim Hakim',
            'email' => '5025241046@student.its.ac.id',
            'title' => 'MCP Process Provider Gate',
            'category' => 'LLM Orchestration',
            'description' => 'Penyaringan otorisasi pemanggilan provider proses lokal melalui Model Context Protocol.',
        ];

        $response = $this->post('/ide-agent', $payload);

        $response->assertStatus(302);
        $response->assertRedirect(route('idea', ['mode' => 'dark']));
    }
}
