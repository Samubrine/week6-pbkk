@extends('layouts.app')

@section('title', 'Profil Mahasiswa - ' . $student['name'] . ' · ' . ($student['specialty'] ?? 'PBKK'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-10">

    {{-- Breadcrumb Navigation --}}
    <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-blue-700 transition-colors">Beranda</a>
        <span>/</span>
        <span class="text-slate-800 font-semibold">Profil Mahasiswa</span>
    </nav>

    @if ($isMikail)
    {{-- Student Profile Header / Hero Card --}}
    <div class="rounded-3xl bg-white border border-slate-200 p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            {{-- Avatar Initials Placeholder --}}
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-blue-700 to-indigo-600 text-white flex items-center justify-center font-bold text-2xl shadow-md shrink-0">
                {{ $student['avatar_initials'] ?? 'MI' }}
            </div>
            <div class="space-y-1.5">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $student['name'] }}
                    </h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 border border-indigo-200">
                        {{ $student['specialty'] }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        Mahasiswa Aktif
                    </span>
                </div>
                <p class="text-sm font-mono font-medium text-blue-700">
                    NRP: {{ $student['nrp'] }}
                </p>
                <p class="text-xs text-slate-600">
                    {{ $student['program'] }} • {{ $student['department'] }} • {{ $student['university'] }}
                </p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 self-stretch md:self-center justify-start md:justify-end border-t md:border-t-0 pt-4 md:pt-0 border-slate-100">
            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200">
                🎓 {{ $student['semester'] }}
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200">
                🏫 Kelas {{ $student['class'] }}
            </span>
        </div>
    </div>

    {{-- Main Grid: 2 Columns for Rich Academic Profile --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Left Column (1 col): Biodata, Contact & Specialty --}}
        <div class="space-y-6">
            {{-- Biodata Card --}}
            <x-info-card
                title="Informasi Pribadi"
                subtitle="Data Pokok & Minat Akademik"
                icon="user"
                badge="{{ $student['specialty'] }}"
                badgeColor="indigo">
                
                <div class="space-y-3 pt-1 text-xs">
                    <div>
                        <span class="text-slate-500 font-medium block">Nama Lengkap</span>
                        <span class="text-slate-900 font-semibold text-sm">{{ $student['name'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Nomor Registrasi Pokok (NRP)</span>
                        <span class="text-blue-700 font-mono font-bold text-sm">{{ $student['nrp'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Minat Utama / Spesialisasi</span>
                        <span class="text-indigo-700 font-semibold text-sm">{{ $student['specialty'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Program Studi</span>
                        <span class="text-slate-900 font-medium">{{ $student['program'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Fakultas & Institut</span>
                        <span class="text-slate-900 font-medium">{{ $student['faculty'] }}</span>
                        <span class="text-slate-600 block">{{ $student['university'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Tentang Mahasiswa</span>
                        <p class="text-slate-600 leading-relaxed mt-1 italic">
                            "{{ $student['bio'] }}"
                        </p>
                    </div>
                </div>

                <x-slot:footer>
                    <div class="text-[11px] text-slate-500">
                        Departemen Teknik Informatika ITS Surabaya
                    </div>
                </x-slot:footer>
            </x-info-card>

            {{-- Contact & Social Portfolio Card --}}
            <x-info-card
                title="Kontak & Repositori"
                subtitle="Tautan Daring & Profil Pengembang"
                icon="code"
                badge="Tersedia"
                badgeColor="slate">

                <div class="space-y-2.5 pt-1 text-xs">
                    <a href="mailto:{{ $student['email'] }}" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 transition-colors border border-slate-200/80">
                        <span class="text-base">✉️</span>
                        <span class="truncate font-medium">{{ $student['email'] }}</span>
                    </a>
                    <a href="{{ $student['github'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 hover:text-slate-900 transition-colors border border-slate-200/80">
                        <span class="text-base">🐙</span>
                        <span class="truncate font-medium">{{ $student['github'] }}</span>
                    </a>
                    <a href="{{ $student['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 p-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-800 transition-colors border border-slate-200/80">
                        <span class="text-base">💼</span>
                        <span class="truncate font-medium">{{ $student['linkedin'] }}</span>
                    </a>
                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between text-[11px] text-slate-500">
                        <span>Showcase Project</span>
                        <a href="https://github.com/Samubrine/security-agent-harness" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">
                            Security Agent Harness &rarr;
                        </a>
                    </div>
                </x-slot:footer>
            </x-info-card>

            {{-- Achievements Card --}}
            <x-info-card
                title="Rekam Prestasi"
                subtitle="Capaian Kompetisi & Usaha Mandiri"
                icon="academic"
                badge="Faktual"
                badgeColor="emerald"
                variant="subtle">

                <div class="space-y-3 pt-1">
                    @foreach ($student['achievements'] as $ach)
                        <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-xs space-y-1">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="text-xs font-bold text-slate-900 leading-snug">{{ $ach['title'] }}</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200 shrink-0">
                                    {{ $ach['badge'] }}
                                </span>
                            </div>
                            <span class="text-[10px] uppercase font-semibold text-slate-500 block">{{ $ach['category'] }}</span>
                            <p class="text-xs text-slate-600 leading-relaxed pt-0.5">
                                {{ $ach['desc'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </x-info-card>
        </div>

        {{-- Right Column (2 cols): Courses & Competencies --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Current Courses Section (8 Authoritative Courses) --}}
            <x-info-card
                title="Mata Kuliah Semester Ini"
                subtitle="Daftar 8 Mata Kuliah Aktif Semester Gasal 2026/2027"
                icon="book"
                badge="8 Mata Kuliah"
                badgeColor="blue"
                variant="default">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2">
                    @foreach ($student['courses'] as $index => $course)
                        <div class="p-3.5 rounded-xl bg-slate-50/90 border border-slate-200/90 hover:border-blue-300 hover:shadow-xs transition-all flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                {{ $index + 1 }}
                            </div>
                            <div class="space-y-0.5 min-w-0 flex-1">
                                <h4 class="text-xs font-bold text-slate-900 leading-snug">{{ $course['name'] }}</h4>
                                <span class="text-[11px] text-slate-500 block">{{ $course['category'] }}</span>
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200 mt-1">
                                    {{ $course['status'] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <div class="flex items-center justify-between text-xs text-slate-600">
                        <span>Departemen Teknik Informatika FTEIC ITS</span>
                        <span class="font-semibold text-slate-900">Kurikulum Berkelanjutan</span>
                    </div>
                </x-slot:footer>
            </x-info-card>

            {{-- Technical & Applied Competencies --}}
            <x-info-card
                title="Kompetensi Teknis & Terapan"
                subtitle="Keahlian rekayasa sistem, arsitektur, dan penerapan kecerdasan buatan"
                icon="cpu"
                badge="3 Bidang"
                badgeColor="indigo"
                variant="default">

                <div class="space-y-3 pt-2">
                    @foreach ($student['competencies_technical'] as $comp)
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between gap-2 flex-wrap">
                                <h4 class="text-xs font-bold text-slate-900 text-sm">{{ $comp['name'] }}</h4>
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-semibold {{ $comp['name'] === 'System Architecture' ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                                    {{ $comp['level'] }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $comp['desc'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <p class="text-xs text-slate-600">
                        Disajikan secara faktual dan proporsional sesuai fokus akademik yang sedang ditempuh.
                    </p>
                </x-slot:footer>
            </x-info-card>

            {{-- Soft & Organizational Competencies --}}
            <x-info-card
                title="Kompetensi Organisasi & Interpersonal"
                subtitle="Keahlian manajemen, komunikasi, dan penyelarasan strategi"
                icon="sparkles"
                badge="4 Bidang"
                badgeColor="slate"
                variant="default">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-2">
                    @foreach ($student['competencies_soft'] as $comp)
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1">
                            <div class="flex items-center justify-between">
                                <h4 class="text-xs font-bold text-slate-900">{{ $comp['name'] }}</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-200/80 text-slate-700">
                                    {{ $comp['level'] }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $comp['desc'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <p class="text-xs text-slate-600">
                        Mendukung kolaborasi tim, tata laksana manajerial, dan komunikasi publik yang efektif.
                    </p>
                </x-slot:footer>
            </x-info-card>

        </div>

    </div>
    @else
    {{-- Clean User Profile for Authenticated Non-Mikail Users --}}
    <div class="rounded-3xl bg-white border border-slate-200 p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-700 to-blue-600 text-white flex items-center justify-center font-bold text-2xl shadow-md shrink-0">
                {{ $student['avatar_initials'] ?? 'U' }}
            </div>
            <div class="space-y-1.5">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        {{ $student['name'] }}
                    </h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                        Akun Terverifikasi
                    </span>
                </div>
                <p class="text-sm font-mono font-medium text-blue-700">
                    {{ $student['email'] }}
                </p>
                <p class="text-xs text-slate-600">
                    Primary Key: <code class="font-mono text-slate-800 font-semibold">users.id #{{ $currentUser->id }}</code> &bull; Terdaftar di Basis Data MySQL
                </p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 self-stretch md:self-center justify-start md:justify-end border-t md:border-t-0 pt-4 md:pt-0 border-slate-100">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-xs">
                <span>🛡️</span> Dashboard Saya
            </a>
        </div>
    </div>

    {{-- Two Column Layout: User Details & Project List --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: User Summary Card --}}
        <div class="space-y-6">
            <x-info-card
                title="Informasi Akun"
                subtitle="Identitas & Kredensial Pengguna"
                icon="user"
                badge="Sesi Aktif"
                badgeColor="indigo">

                <div class="space-y-3 pt-1 text-xs">
                    <div>
                        <span class="text-slate-500 font-medium block">Nama Lengkap</span>
                        <span class="text-slate-900 font-semibold text-sm">{{ $student['name'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Alamat Email</span>
                        <span class="text-blue-700 font-mono font-medium text-xs">{{ $student['email'] }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">ID Pengguna (Primary Key)</span>
                        <span class="text-slate-900 font-mono font-bold">#{{ $currentUser->id }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Jumlah Proyek Terkait</span>
                        <span class="text-indigo-700 font-bold text-sm">{{ $userProjects->count() }} Proyek (HasMany)</span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Waktu Pendaftaran</span>
                        <span class="text-slate-700">{{ $currentUser->created_at ? $currentUser->created_at->format('d M Y, H:i') : 'Saat Seeding' }}</span>
                    </div>
                </div>

                <x-slot:footer>
                    <div class="text-[11px] text-slate-500">
                        Terkoneksi ke tabel <code>users</code> via Laravel Breeze
                    </div>
                </x-slot:footer>
            </x-info-card>
        </div>

        {{-- Right Column: Projects from Eloquent --}}
        <div class="lg:col-span-2 space-y-6">
            <x-info-card
                title="Proposal Proyek Agentic AI"
                subtitle="Daftar Proyek Terhubung dengan Akun Anda"
                icon="cpu"
                badge="{{ $userProjects->count() }} Proyek"
                badgeColor="blue"
                variant="default">

                @if ($userProjects->isEmpty())
                    <div class="text-center py-8 space-y-2">
                        <div class="w-10 h-10 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                            📭
                        </div>
                        <h4 class="text-sm font-semibold text-slate-900">Belum Ada Proyek</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Akun Anda saat ini belum memiliki proposal proyek yang terdaftar di basis data.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('idea') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                Ajukan Ide Baru &rarr;
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-4 pt-2">
                        @foreach ($userProjects as $proj)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-100 text-indigo-700">
                                            🤖 {{ $proj->tema_agent }}
                                        </span>
                                        <h4 class="text-sm font-bold text-slate-900 pt-1 leading-snug">
                                            {{ $proj->judul }}
                                        </h4>
                                    </div>
                                    <span class="text-[11px] font-mono text-slate-400">#{{ $proj->id }}</span>
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $proj->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </p>
                                <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-slate-400">
                                    <span>Dibuat: {{ $proj->created_at->format('d M Y, H:i') }}</span>
                                    <span class="font-mono text-slate-500">
                                        Key: {{ $proj->api_key_secure ? Str::limit($proj->api_key_secure, 16, '...') : '(null)' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <x-slot:footer>
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>Terkoneksi Foreign Key <code>projects.user_id</code></span>
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline font-semibold">Buka Dashboard &rarr;</a>
                    </div>
                </x-slot:footer>
            </x-info-card>
        </div>
    </div>
    @endif

</div>
@endsection
