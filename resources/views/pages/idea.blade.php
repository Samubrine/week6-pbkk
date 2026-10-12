@extends('layouts.app')

@section('title', $project['title'] . ' - ' . $project['subtitle'] . ($isDark ? ' (Dark Mode)' : ''))

@section('content')
{{--
    BONUS CHALLENGE 1 — DYNAMIC DARK MODE:
    Switches theme styling dynamically based on PHP/Blade variable $isDark ($mode === 'dark').
    All Tailwind classes are written explicitly to guarantee zero purging during production build.
--}}
@php
    $pageContainerClass = $isDark ? 'bg-slate-950 text-slate-100' : 'bg-slate-50 text-slate-800';
    $heroBoxClass = $isDark ? 'bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 border-slate-800 text-white shadow-2xl' : 'bg-gradient-to-br from-white via-indigo-50/40 to-blue-50/50 border-slate-200 text-slate-900 shadow-sm';
    $headingClass = $isDark ? 'text-white' : 'text-slate-900';
    $subtextClass = $isDark ? 'text-slate-300' : 'text-slate-600';
    $sectionTitleClass = $isDark ? 'text-slate-100' : 'text-slate-900';
    $cardVariant = $isDark ? 'dark' : 'default';
    $formBgClass = $isDark ? 'bg-slate-900/90 border-slate-800 text-slate-100' : 'bg-white border-slate-200 text-slate-800';
    $inputClass = $isDark ? 'bg-slate-950 border-slate-700 text-slate-100 placeholder-slate-500 focus:border-cyan-400 focus:ring-cyan-400/20' : 'bg-slate-50 border-slate-300 text-slate-900 placeholder-slate-400 focus:border-blue-600 focus:ring-blue-600/20';
    $pipelineStepBg = $isDark ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200';
@endphp

<div class="transition-colors duration-300 min-h-screen {{ $pageContainerClass }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-12">

        {{-- Top Navigation & Mode Status Indicator (Harmonized with global navbar) --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b pb-4 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
            <nav class="flex items-center gap-2 text-xs {{ $isDark ? 'text-slate-400' : 'text-slate-500' }}" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-blue-500 transition-colors">Beranda</a>
                <span>/</span>
                <span class="{{ $isDark ? 'text-slate-200 font-semibold' : 'text-slate-800 font-semibold' }}">Ide Agent</span>
            </nav>

            {{-- Clean Mode Status Badge (Avoids duplicate buttons with header) --}}
            <div class="flex items-center gap-3 self-stretch sm:self-auto justify-between sm:justify-end">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold border {{ $isDark ? 'bg-slate-900 text-cyan-300 border-cyan-800/80 shadow-xs' : 'bg-white text-slate-700 border-slate-200 shadow-xs' }}">
                    <span class="w-2 h-2 rounded-full {{ $isDark ? 'bg-cyan-400' : 'bg-amber-500' }}"></span>
                    <span>{{ $isDark ? 'Dark Mode Aktif (?mode=dark)' : 'Light Mode Aktif' }}</span>
                </span>
            </div>
        </div>

        {{-- Dynamic Status Banner for Mode Indication (Corrected Contrast & No clashing light gradient) --}}
        @if ($isDark)
            <x-status-banner type="mode" title="Bonus Challenge 1: Dark Mode Aktif" badgeText="Challenge 1" class="shadow-xl">
                <p class="text-xs sm:text-sm text-cyan-100 leading-relaxed">
                    Halaman ini berhasil di-render dalam <strong class="text-white font-bold">Mode Gelap Dinamis</strong> melalui parameter query <code class="px-1.5 py-0.5 rounded bg-slate-950 text-cyan-300 font-mono text-xs border border-cyan-800">?mode=dark</code>. Seluruh layout (navbar, konten, kartu, dan footer) menyesuaikan tema gelap secara harmonis dan terbaca jelas.
                </p>
                <x-slot:action>
                    <a href="{{ route('idea') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-cyan-300 border border-cyan-700/80 shadow-xs transition-colors">
                        Kembali ke Light Mode ☀️
                    </a>
                </x-slot:action>
            </x-status-banner>
        @endif

        {{-- Flash Success Status Banner for Form Submission --}}
        @if (session('success'))
            <x-status-banner type="success" title="Pengajuan Ide Riset Berhasil!" class="shadow-sm">
                <p class="text-xs sm:text-sm text-emerald-950 font-medium">
                    {{ session('success') }}
                </p>
            </x-status-banner>
        @endif

        {{-- Validation Error Banner --}}
        @if ($errors->any())
            <x-status-banner type="error" title="Gagal Mengirimkan Formulir Ide" class="shadow-sm">
                <p class="text-xs sm:text-sm text-rose-950 font-medium">
                    Terdapat kesalahan pengisian data pada formulir. Mohon periksa kembali kolom isian yang disorot merah.
                </p>
            </x-status-banner>
        @endif

        @if ($isMikail)
        {{-- Hero Presentation of Security Agent Harness --}}
        <section class="rounded-3xl border p-8 sm:p-12 relative overflow-hidden transition-all duration-300 {{ $heroBoxClass }}">
            <div class="relative z-10 max-w-4xl space-y-5">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $isDark ? 'bg-cyan-950 text-cyan-300 border border-cyan-700/50' : 'bg-indigo-100 text-indigo-800 border border-indigo-200' }}">
                        <span class="w-2 h-2 rounded-full {{ $isDark ? 'bg-cyan-400' : 'bg-indigo-600' }} animate-pulse"></span>
                        {{ $project['type'] }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isDark ? 'bg-slate-800 text-slate-300 border border-slate-700' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                        {{ $project['status'] }}
                    </span>
                </div>

                <div class="space-y-2">
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight {{ $headingClass }}">
                        {{ $project['title'] }}
                    </h1>
                    <p class="text-base sm:text-lg font-medium text-cyan-400">
                        {{ $project['subtitle'] }}
                    </p>
                </div>

                <p class="text-sm sm:text-base leading-relaxed {{ $subtextClass }}">
                    {{ $project['description'] }}
                </p>

                <div class="flex items-center gap-3 pt-2 flex-wrap">
                    <a href="{{ $project['repository'] }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all">
                        <span>🐙</span>
                        <span>Lihat Repositori di GitHub &rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- Core Architectural Distinction: Probabilistic Brain vs Deterministic Spine --}}
        <section class="space-y-4">
            <div class="border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
                <h2 class="text-2xl font-bold tracking-tight {{ $sectionTitleClass }}">
                    Konsep Arsitektur: Probabilistic Brain vs Deterministic Spine
                </h2>
                <p class="text-xs sm:text-sm {{ $isDark ? 'text-slate-400' : 'text-slate-600' }} mt-1">
                    Pemisahan tanggung jawab secara tegas antara kecerdasan hipotesis LLM dengan penegakan kebijakan eksekusi runtime deterministik.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($project['pillars'] as $pillar)
                    <x-info-card
                        title="{{ $pillar['name'] }}"
                        subtitle="{{ $pillar['subtitle'] }}"
                        icon="{{ $pillar['badge'] === 'Local LLM' ? 'cpu' : 'check' }}"
                        badge="{{ $pillar['badge'] }}"
                        badgeColor="{{ $pillar['badge'] === 'Local LLM' ? 'indigo' : 'emerald' }}"
                        variant="{{ $cardVariant }}">

                        <p class="text-xs sm:text-sm leading-relaxed {{ $isDark ? 'text-slate-300' : 'text-slate-600' }}">
                            {{ $pillar['description'] }}
                        </p>

                        <x-slot:footer>
                            <span class="text-[11px] font-semibold {{ $pillar['badge'] === 'Local LLM' ? 'text-indigo-400' : 'text-emerald-500' }}">
                                {{ $pillar['badge'] === 'Local LLM' ? 'Perencanaan & Hipotesis Otonom' : 'Kontrol Eksekusi, Kebijakan, dan Bukti' }}
                            </span>
                        </x-slot:footer>
                    </x-info-card>
                @endforeach
            </div>
        </section>

        {{-- Problem Statement & Objective Section using Reusable <x-info-card> --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-info-card
                title="Latar Belakang & Tantangan Investigasi"
                subtitle="Dilema Otomasi Keamanan Konvensional"
                icon="book"
                badge="Problem Space"
                badgeColor="rose"
                variant="{{ $cardVariant }}">
                <p class="text-xs sm:text-sm leading-relaxed {{ $isDark ? 'text-slate-300' : 'text-slate-600' }}">
                    {{ $project['problem'] }}
                </p>
                <x-slot:footer>
                    <span class="text-xs text-rose-500 font-semibold">Tantangan: Kurangnya Auditabilitas &amp; Risiko Pelanggaran Scope</span>
                </x-slot:footer>
            </x-info-card>

            <x-info-card
                title="Tujuan & Solusi Sistem"
                subtitle="Pendekatan Runtime Terkontrol & Local-First"
                icon="check"
                badge="Solution Scope"
                badgeColor="emerald"
                variant="{{ $cardVariant }}">
                <p class="text-xs sm:text-sm leading-relaxed {{ $isDark ? 'text-slate-300' : 'text-slate-600' }}">
                    {{ $project['objective'] }}
                </p>
                <x-slot:footer>
                    <span class="text-xs text-emerald-500 font-semibold">Solusi: Controlled Investigation Runtime dengan Replay Ground Truth</span>
                </x-slot:footer>
            </x-info-card>
        </section>

        {{-- Investigation Architecture Pipeline Visualization (10 Steps Grouped into 4 Logical Phases) --}}
        <section class="space-y-6">
            <div class="border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
                <h2 class="text-2xl font-bold tracking-tight {{ $sectionTitleClass }}">
                    Alur Arsitektur Investigasi (Architecture Pipeline)
                </h2>
                <p class="text-xs sm:text-sm {{ $isDark ? 'text-slate-400' : 'text-slate-600' }} mt-1">
                    Visualisasi terstruktur representasi pipeline 10 langkah dari penerimaan tujuan investigasi hingga verifikasi laporan temuan.
                </p>
            </div>

            {{-- Phase 1 & 2 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Phase 1: Planning --}}
                <div class="p-6 rounded-3xl border space-y-4 {{ $pipelineStepBg }}">
                    <div class="flex items-center justify-between border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-100' }}">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Fase 1: Perencanaan &amp; Hipotesis</span>
                        <span class="text-[11px] text-slate-500">Steps 01 - 03</span>
                    </div>
                    <div class="space-y-3">
                        @foreach (array_slice($project['architecture_steps'], 0, 3) as $step)
                            <div class="p-3.5 rounded-xl border flex items-start gap-3 {{ $isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200/80' }}">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-xs shrink-0 {{ $isDark ? 'bg-cyan-950 text-cyan-300 border border-cyan-800' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                                    {{ $step['step'] }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold {{ $headingClass }}">{{ $step['name'] }}</h4>
                                    <p class="text-[11px] {{ $subtextClass }} leading-relaxed pt-0.5">{{ $step['role'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Phase 2: Gating & Policy --}}
                <div class="p-6 rounded-3xl border space-y-4 {{ $pipelineStepBg }}">
                    <div class="flex items-center justify-between border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-100' }}">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Fase 2: Gerbang Izin &amp; Routing</span>
                        <span class="text-[11px] text-slate-500">Steps 04 - 06</span>
                    </div>
                    <div class="space-y-3">
                        @foreach (array_slice($project['architecture_steps'], 3, 3) as $step)
                            <div class="p-3.5 rounded-xl border flex items-start gap-3 {{ $isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200/80' }}">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-xs shrink-0 {{ $isDark ? 'bg-indigo-950 text-indigo-300 border border-indigo-800' : 'bg-indigo-100 text-indigo-800 border border-indigo-200' }}">
                                    {{ $step['step'] }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold {{ $headingClass }}">{{ $step['name'] }}</h4>
                                    <p class="text-[11px] {{ $subtextClass }} leading-relaxed pt-0.5">{{ $step['role'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Phase 3 & 4 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Phase 3: Execution & Observation --}}
                <div class="p-6 rounded-3xl border space-y-4 {{ $pipelineStepBg }}">
                    <div class="flex items-center justify-between border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-100' }}">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Fase 3: Eksekusi &amp; Observasi</span>
                        <span class="text-[11px] text-slate-500">Steps 07 - 08</span>
                    </div>
                    <div class="space-y-3">
                        @foreach (array_slice($project['architecture_steps'], 6, 2) as $step)
                            <div class="p-3.5 rounded-xl border flex items-start gap-3 {{ $isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200/80' }}">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-xs shrink-0 {{ $isDark ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                                    {{ $step['step'] }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold {{ $headingClass }}">{{ $step['name'] }}</h4>
                                    <p class="text-[11px] {{ $subtextClass }} leading-relaxed pt-0.5">{{ $step['role'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Phase 4: Synthesis & Verification --}}
                <div class="p-6 rounded-3xl border space-y-4 {{ $pipelineStepBg }}">
                    <div class="flex items-center justify-between border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-100' }}">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Fase 4: Temuan &amp; Verifikasi Replay</span>
                        <span class="text-[11px] text-slate-500">Steps 09 - 10</span>
                    </div>
                    <div class="space-y-3">
                        @foreach (array_slice($project['architecture_steps'], 8, 2) as $step)
                            <div class="p-3.5 rounded-xl border flex items-start gap-3 {{ $isDark ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50 border-slate-200/80' }}">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-xs shrink-0 {{ $isDark ? 'bg-amber-950 text-amber-300 border border-amber-800' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                    {{ $step['step'] }}
                                </span>
                                <div>
                                    <h4 class="text-xs font-bold {{ $headingClass }}">{{ $step['name'] }}</h4>
                                    <p class="text-[11px] {{ $subtextClass }} leading-relaxed pt-0.5">{{ $step['role'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Truthful Key Features Grid --}}
        <section class="space-y-6">
            <div class="border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
                <h2 class="text-2xl font-bold tracking-tight {{ $sectionTitleClass }}">
                    Kapabilitas &amp; Fitur Utama Harness
                </h2>
                <p class="text-xs sm:text-sm {{ $isDark ? 'text-slate-400' : 'text-slate-600' }} mt-1">
                    Fitur teknis yang diimplementasikan pada runtime CLI Security Agent Harness.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($project['features'] as $feat)
                    <div class="p-5 rounded-2xl border {{ $pipelineStepBg }} space-y-2 hover:shadow-xs transition-shadow">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center font-bold text-xs {{ $isDark ? 'bg-slate-800 text-cyan-400 border border-slate-700' : 'bg-blue-50 text-blue-700 border border-blue-100' }}">
                            ✓
                        </div>
                        <h4 class="text-sm font-bold {{ $headingClass }}">{{ $feat['title'] }}</h4>
                        <p class="text-xs {{ $subtextClass }} leading-relaxed">
                            {{ $feat['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Controlled Security Notice Card --}}
        <div class="p-5 rounded-2xl border {{ $isDark ? 'bg-slate-900 border-amber-900/60 text-amber-200' : 'bg-amber-50 border-amber-200 text-amber-900' }}">
            <div class="flex items-start gap-3">
                <span class="text-lg">🛡️</span>
                <div class="space-y-1 text-xs leading-relaxed">
                    <strong class="font-bold block">Prinsip Keamanan &amp; Etika Operasional:</strong>
                    <p>{{ $project['safety_notice'] }}</p>
                </div>
            </div>
        </div>
        @else
        {{-- Hero for Non-Mikail Authenticated User --}}
        <section class="rounded-3xl border p-8 sm:p-12 relative overflow-hidden transition-all duration-300 {{ $heroBoxClass }}">
            <div class="relative z-10 max-w-4xl space-y-5">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $isDark ? 'bg-cyan-950 text-cyan-300 border border-cyan-700/50' : 'bg-indigo-100 text-indigo-800 border border-indigo-200' }}">
                        <span class="w-2 h-2 rounded-full {{ $isDark ? 'bg-cyan-400' : 'bg-indigo-600' }} animate-pulse"></span>
                        {{ $project['type'] ?? 'Daftar Proyek Pengguna' }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isDark ? 'bg-slate-800 text-slate-300 border border-slate-700' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                        {{ $project['status'] ?? 'Tersimpan di Basis Data MySQL' }}
                    </span>
                </div>

                <div class="space-y-2">
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight {{ $headingClass }}">
                        {{ $project['title'] }}
                    </h1>
                    <p class="text-base sm:text-lg font-medium text-cyan-400">
                        {{ $project['subtitle'] }}
                    </p>
                </div>

                <p class="text-sm sm:text-base leading-relaxed {{ $subtextClass }}">
                    {{ $project['description'] }}
                </p>

                <div class="flex items-center gap-3 pt-2 flex-wrap">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all">
                        <span>🛡️</span>
                        <span>Kelola Proyek di Dashboard &rarr;</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- Section: User's Own Projects --}}
        <section class="space-y-6">
            <div class="border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
                <h2 class="text-2xl font-bold tracking-tight {{ $sectionTitleClass }}">
                    Proposal Proyek Agentic AI Milik Anda
                </h2>
                <p class="text-xs sm:text-sm {{ $isDark ? 'text-slate-400' : 'text-slate-600' }} mt-1">
                    Daftar proposal proyek yang tersimpan atas nama akun Anda pada tabel <code>projects</code>.
                </p>
            </div>

            @if ($userProjects->isEmpty())
                <div class="p-8 rounded-3xl border text-center space-y-3 {{ $formBgClass }}">
                    <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-xl text-slate-400">
                        📭
                    </div>
                    <h3 class="text-base font-semibold {{ $headingClass }}">Belum Ada Proposal Proyek</h3>
                    <p class="text-xs {{ $subtextClass }} max-w-md mx-auto">
                        Anda belum memiliki proposal ide proyek AI di basis data. Silakan isi formulir di bawah ini untuk mengajukan ide riset baru.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($userProjects as $proj)
                        <div class="p-6 rounded-2xl border space-y-4 {{ $isDark ? 'bg-slate-900/60 border-slate-800' : 'bg-white border-slate-200' }}">
                            <div class="flex items-start justify-between gap-3">
                                <div class="space-y-1">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $isDark ? 'bg-cyan-950 text-cyan-300 border border-cyan-800' : 'bg-indigo-50 text-indigo-700 border border-indigo-200' }}">
                                        🤖 {{ $proj->tema_agent }}
                                    </span>
                                    <h4 class="text-base font-bold {{ $headingClass }} pt-1 leading-snug">
                                        {{ $proj->judul }}
                                    </h4>
                                </div>
                                <span class="text-[11px] font-mono text-slate-400 whitespace-nowrap">#{{ $proj->id }}</span>
                            </div>

                            <p class="text-xs sm:text-sm leading-relaxed {{ $subtextClass }}">
                                {{ $proj->deskripsi ?? 'Tidak ada deskripsi yang dilampirkan.' }}
                            </p>

                            <div class="pt-3 border-t {{ $isDark ? 'border-slate-800' : 'border-slate-100' }} flex items-center justify-between text-[11px] text-slate-400">
                                <span>Dibuat: {{ $proj->created_at->format('d M Y, H:i') }}</span>
                                <span class="font-mono">
                                    Key: {{ $proj->api_key_secure ? Str::limit($proj->api_key_secure, 16, '...') : '(null)' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
        @endif

        {{-- Section 5: Idea Submission / Feedback Form --}}
        <section class="space-y-6 pt-4">
            <div class="border-b pb-3 {{ $isDark ? 'border-slate-800' : 'border-slate-200' }}">
                <h2 class="text-2xl font-bold tracking-tight {{ $sectionTitleClass }}">
                    Formulir Pengusulan Ide / Masukan Kapabilitas
                </h2>
                <p class="text-xs sm:text-sm {{ $isDark ? 'text-slate-400' : 'text-slate-600' }} mt-1">
                    Ajukan usulan skill investigasi baru, integrasi native tools, maupun saran pengembangan harness.
                </p>
            </div>

            <div class="max-w-3xl rounded-3xl border p-6 sm:p-8 shadow-sm transition-colors {{ $formBgClass }}">
                <form action="{{ route('idea.submit') }}" method="POST" class="space-y-6" novalidate>
                    @csrf

                    {{-- Preserve current dark mode state across form redirection --}}
                    <input type="hidden" name="_mode" value="{{ $mode }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Name Field --}}
                        <div class="space-y-1.5">
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'text-slate-300' : 'text-slate-700' }}">
                                Nama Pengusul <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', Auth::user()?->name) }}"
                                placeholder="Contoh: Mikail Ibrahim Hakim"
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all focus:outline-none focus:ring-2 {{ $inputClass }} @error('name') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                            @error('name')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'text-slate-300' : 'text-slate-700' }}">
                                Alamat Email ITS <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', Auth::user()?->email) }}"
                                placeholder="nama@student.its.ac.id"
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all focus:outline-none focus:ring-2 {{ $inputClass }} @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                            @error('email')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        {{-- Idea Title Field (2 cols) --}}
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="title" class="block text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'text-slate-300' : 'text-slate-700' }}">
                                Judul Usulan Ide / Fitur Harness <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Contoh: Integrasi Skill DNS Log Correlation via MCP"
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all focus:outline-none focus:ring-2 {{ $inputClass }} @error('title') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                            @error('title')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category Field (1 col) --}}
                        <div class="space-y-1.5">
                            <label for="category" class="block text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'text-slate-300' : 'text-slate-700' }}">
                                Kategori <span class="text-rose-500">*</span>
                            </label>
                            <select
                                id="category"
                                name="category"
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all focus:outline-none focus:ring-2 {{ $inputClass }} @error('category') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih Kategori...</option>
                                <option value="Autonomous Agents" {{ old('category') === 'Autonomous Agents' ? 'selected' : '' }}>Autonomous Agents</option>
                                <option value="LLM Orchestration" {{ old('category') === 'LLM Orchestration' ? 'selected' : '' }}>LLM Orchestration</option>
                                <option value="Student Productivity" {{ old('category') === 'Student Productivity' ? 'selected' : '' }}>Student Productivity</option>
                                <option value="Academic Advising" {{ old('category') === 'Academic Advising' ? 'selected' : '' }}>Academic Advising</option>
                                <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>Lainnya / General</option>
                            </select>
                            @error('category')
                                <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description Field --}}
                    <div class="space-y-1.5">
                        <label for="description" class="block text-xs font-semibold uppercase tracking-wider {{ $isDark ? 'text-slate-300' : 'text-slate-700' }}">
                            Deskripsi Konseptual Ide <span class="text-rose-500">*</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Jelaskan kebutuhan kapabilitas investigasi, batasan policy yang diharapkan, atau mekanisme validasi ground truth yang diusulkan..."
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-all focus:outline-none focus:ring-2 leading-relaxed {{ $inputClass }} @error('description') border-rose-500 focus:border-rose-500 focus:ring-rose-500/20 @enderror">{{ old('description') }}</textarea>
                        <div class="flex justify-between items-center text-[11px] {{ $isDark ? 'text-slate-400' : 'text-slate-500' }}">
                            <span>Minimal 15 karakter agar ide informatif dan dapat ditinjau.</span>
                            @error('description')
                                <span class="text-rose-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Action Button --}}
                    <div class="pt-2 flex items-center justify-between gap-4 flex-wrap">
                        <div class="flex items-center gap-2 text-xs {{ $isDark ? 'text-slate-400' : 'text-slate-500' }}">
                            <span>🔒 Dilindungi CSRF Token Laravel</span>
                            <span>•</span>
                            <span>Validasi Server-Side Aktif</span>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm shadow-md hover:shadow-lg transition-all focus:outline-none focus:ring-2 {{ $isDark ? 'bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white focus:ring-cyan-400' : 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Ide Riset
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </div>
</div>
@endsection
