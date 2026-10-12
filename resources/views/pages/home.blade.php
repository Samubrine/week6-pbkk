@extends('layouts.app')

@section('title', 'Beranda - ' . $student['name'] . ' · ' . $student['specialty'])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-10">

    {{-- BONUS CHALLENGE 2: Dynamic User Status / Welcome Greeting --}}
    @if (!empty($user))
        <x-status-banner type="welcome" title="Sapaan Pengunjung" class="shadow-sm">
            <p class="text-sm sm:text-base text-indigo-950">
                Selamat datang, <strong class="font-bold underline decoration-indigo-400 decoration-2">{{ $user }}</strong>! Anda sedang mengakses Portal Profil Akademik PBKK &amp; Showcase Proyek <span class="font-semibold text-blue-700">{{ $project['title'] }}</span> Departemen Teknik Informatika ITS.
            </p>
            <x-slot:action>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/90 hover:bg-white text-xs text-indigo-800 font-semibold border border-indigo-200 transition-colors shadow-xs">
                    Reset Filter User ✕
                </a>
            </x-slot:action>
        </x-status-banner>
    @else
        <x-status-banner type="info" title="Informasi Sistem PBKK">
            <p class="text-xs sm:text-sm text-blue-900 leading-relaxed">
                Aplikasi ini menyajikan profil akademik mahasiswa Departemen Teknik Informatika ITS dengan fokus pada <strong class="font-semibold">System Architecture</strong> dan showcase proyek <strong class="font-semibold">Security Agent Harness</strong> (Pertemuan 4 PBKK). Coba tambahkan parameter URL <code class="px-1.5 py-0.5 rounded bg-blue-100 text-blue-800 font-mono text-xs">/beranda?user=NamaAnda</code> untuk melihat sapaan dinamis.
            </p>
        </x-status-banner>
    @endif

    {{-- Refined Hero Section: Bento Header --}}
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-white p-8 sm:p-12 shadow-xl border border-slate-800/80">
        {{-- Background decorative radial grid --}}
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        
        <div class="relative z-10 max-w-4xl space-y-6">
            <div class="flex items-center gap-2.5 flex-wrap">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-500/20 text-cyan-300 text-xs font-semibold border border-cyan-500/30">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    {{ $student['headline'] }}
                </span>
                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-800/80 text-slate-300 text-xs font-medium border border-slate-700">
                    🎓 Semester 5 • Gasal 2026/2027
                </span>
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight text-white">
                    {{ $student['name'] }}
                </h1>
                <p class="text-base sm:text-xl font-medium text-cyan-400">
                    Spesialisasi &amp; Minat: {{ $student['specialty'] }}
                </p>
            </div>

            <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-3xl">
                Mahasiswa Computer Science di Institut Teknologi Sepuluh Nopember (ITS) yang tertarik pada <strong class="text-white">System Architecture</strong> dan perancangan sistem terstruktur yang scalable, organizational strategy, serta penerapan applied AI. Saat ini sedang mengembangkan <strong class="text-cyan-300">{{ $project['title'] }}</strong>, sebuah harness investigasi keamanan otonom local-first berbasis CLI.
            </p>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="{{ route('profile') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Lihat Profil Akademik
                </a>

                <a href="{{ route('idea') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-slate-100 font-semibold text-sm border border-slate-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-slate-400">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Eksplorasi Security Agent Harness
                </a>

                <a href="{{ $project['repository'] }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-slate-900/90 hover:bg-slate-800 text-slate-200 font-semibold text-sm border border-slate-700 transition-all">
                    <span>🐙</span>
                    <span>Repository GitHub</span>
                </a>

                <a href="{{ route('idea', ['mode' => 'dark']) }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-indigo-950/80 hover:bg-indigo-900 text-indigo-200 font-semibold text-sm border border-indigo-700/50 transition-all">
                    <span>🌙</span>
                    <span>Coba Dark Mode</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Reusable Component Section: Bento Grid in Action --}}
    <section class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Ringkasan Mahasiswa &amp; Proyek</h2>
                <p class="text-sm text-slate-600 mt-1">Komponen kartu dibangun menggunakan reusable Blade component <code class="text-blue-700 bg-blue-50 px-1 py-0.5 rounded">&lt;x-info-card&gt;</code>.</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 self-start sm:self-auto">
                ✓ Dynamic Controller Data
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Card 1: Identitas & Spesialisasi --}}
            <x-info-card
                title="Identitas & Minat"
                subtitle="Data Pokok Mahasiswa Teknik Informatika ITS"
                icon="user"
                badge="{{ $student['specialty'] }}"
                badgeColor="indigo"
                variant="highlighted">
                
                <div class="space-y-3 pt-1">
                    <div class="flex justify-between items-center py-1.5 border-b border-blue-100">
                        <span class="text-xs text-slate-500 font-medium">Nama Lengkap</span>
                        <span class="text-xs font-semibold text-slate-900 text-right">{{ $student['name'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5 border-b border-blue-100">
                        <span class="text-xs text-slate-500 font-medium">NRP Mahasiswa</span>
                        <span class="text-xs font-mono font-semibold text-blue-700 text-right">{{ $student['nrp'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5 border-b border-blue-100">
                        <span class="text-xs text-slate-500 font-medium">Spesialisasi</span>
                        <span class="text-xs font-semibold text-indigo-700 text-right">{{ $student['specialty'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-xs text-slate-500 font-medium">Semester</span>
                        <span class="text-xs font-semibold text-slate-900 text-right">{{ $student['semester'] }}</span>
                    </div>
                </div>

                <x-slot:action>
                    <a href="{{ route('profile') }}" class="text-xs font-semibold text-blue-700 hover:underline flex items-center gap-1 group">
                        Detail Profil
                        <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                    </a>
                </x-slot:action>

                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <span>Departemen Teknik Informatika FTEIC ITS</span>
                        <span class="font-medium text-slate-700">Kelas {{ $student['class'] }}</span>
                    </div>
                </x-slot:footer>
            </x-info-card>

            {{-- Card 2: Proyek Riil: Security Agent Harness --}}
            <x-info-card
                title="{{ $project['title'] }}"
                subtitle="{{ $project['subtitle'] }}"
                icon="cpu"
                badge="{{ $project['status'] }}"
                badgeColor="indigo"
                variant="default">

                <div class="space-y-3 pt-1">
                    <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                        {{ $project['tagline'] }}
                    </p>

                    <div class="space-y-2 pt-1 text-xs">
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span class="font-semibold text-slate-900 block text-[11px]">🧠 Probabilistic Brain:</span>
                            <span class="text-slate-600 text-[11px]">LLM lokal merumuskan kebutuhan &amp; hipotesis investigasi.</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span class="font-semibold text-slate-900 block text-[11px]">🛡️ Deterministic Spine:</span>
                            <span class="text-slate-600 text-[11px]">Harness mengontrol policy, necessity gate &amp; evidence replay.</span>
                        </div>
                    </div>
                </div>

                <x-slot:action>
                    <a href="{{ route('idea') }}" class="text-xs font-semibold text-indigo-700 hover:underline flex items-center gap-1 group">
                        Spesifikasi
                        <span class="group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                    </a>
                </x-slot:action>

                <x-slot:footer>
                    <div class="flex items-center justify-between">
                        <span class="text-emerald-700 font-medium">✓ CLI Application</span>
                        <a href="{{ $project['repository'] }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">
                            GitHub Repository &rarr;
                        </a>
                    </div>
                </x-slot:footer>
            </x-info-card>

            {{-- Card 3: Rekam Prestasi Faktual --}}
            <x-info-card
                title="Rekam Prestasi Mahasiswa"
                subtitle="Capaian Ilmiah & Kewirausahaan Digital"
                icon="check"
                badge="Terverifikasi"
                badgeColor="emerald"
                variant="emerald">

                <div class="space-y-3 pt-1 text-xs">
                    @foreach ($student['achievements'] as $ach)
                        <div class="p-3.5 rounded-xl bg-white/95 border border-emerald-200 space-y-1">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="font-bold text-slate-900 text-xs leading-snug">{{ $ach['title'] }}</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200 shrink-0">
                                    {{ $ach['badge'] }}
                                </span>
                            </div>
                            <p class="text-slate-600 text-[11px] leading-relaxed pt-0.5">
                                {{ $ach['desc'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between text-emerald-900 font-medium">
                        <span>Faktual &amp; Sesuai Profil</span>
                        <span class="text-slate-600">8 Mata Kuliah Aktif</span>
                    </div>
                </x-slot:footer>
            </x-info-card>
        </div>
    </section>

    {{-- Quick Courses Preview Cloud --}}
    <section class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-100 pb-3">
            <div>
                <h3 class="text-lg font-bold text-slate-900 tracking-tight">
                    8 Mata Kuliah Semester Ini (Gasal 2026/2027)
                </h3>
                <p class="text-xs text-slate-500">Mata kuliah yang sedang aktif ditempuh di Departemen Teknik Informatika ITS.</p>
            </div>
            <a href="{{ route('profile') }}" class="text-xs font-semibold text-blue-700 hover:underline flex items-center gap-1 self-start sm:self-auto">
                Lihat Detail Jadwal &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 pt-1">
            @foreach ($student['courses'] as $index => $c)
                <div class="p-3 rounded-xl bg-slate-50/90 border border-slate-200/80 flex items-start gap-2.5">
                    <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                        {{ $index + 1 }}
                    </span>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-slate-900 leading-tight truncate" title="{{ $c['name'] }}">{{ $c['name'] }}</h4>
                        <span class="text-[10px] text-slate-500 block truncate">{{ $c['category'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Technical Highlights / Architecture Banner --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs">
        <h3 class="text-lg font-bold text-slate-900 tracking-tight mb-4">
            Arsitektur Aplikasi &amp; Alur Data Controller &rarr; View
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-700">Controller</span>
                <p class="font-semibold text-slate-900 text-sm">PageController</p>
                <p class="text-slate-600">Mengelola request <code class="text-slate-800">/</code>, <code class="text-slate-800">/profil-mahasiswa</code>, dan <code class="text-slate-800">/ide-agent</code> secara terpusat.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-700">Blade Inheritance</span>
                <p class="font-semibold text-slate-900 text-sm">layouts/app.blade.php</p>
                <p class="text-slate-600">Struktur HTML tunggal dengan navigasi dan footer ITS yang diwarisi child views.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700">Vite Pipeline</span>
                <p class="font-semibold text-slate-900 text-sm">Tailwind CSS 4.0</p>
                <p class="text-slate-600">Kompilasi asset modern lokal melalui NPM tanpa ketergantungan stylesheet CDN.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700">Two Bonus Challenges</span>
                <p class="font-semibold text-slate-900 text-sm">Dark Mode &amp; Sapaan</p>
                <p class="text-slate-600">Dynamic Blade logic berbasis query string yang aman dan teruji otomatis.</p>
            </div>
        </div>
    </section>

</div>
@endsection
