<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * Produces realistic Agentic AI research proposal data.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $aiThemes = ['Ollama', 'OpenAI', 'Anthropic', 'HuggingFace', 'Local LLM'];
        $focusAreas = [
            'Autonomous Security Investigation Harness',
            'Academic Advising & Curriculum Planner Agent',
            'Automated Code Quality & Vulnerability Triager',
            'Distributed Knowledge Graph Constructor',
            'Deterministic Policy & Guardrails Enforcer',
            'Multi-Agent System for Threat Surface Reconnaissance',
            'Local-First Evidence Replay & Forensic Auditor',
            'Adaptive Learning Assistant with RAG Pipeline',
        ];

        return [
            'judul' => fake()->randomElement($focusAreas).' - '.fake()->words(3, true),
            'deskripsi' => fake()->paragraphs(2, true),
            'tema_agent' => fake()->randomElement($aiThemes),
            'api_key_secure' => 'sk-pbkk-'.fake()->sha256(),
            'user_id' => User::factory(),
        ];
    }
}
