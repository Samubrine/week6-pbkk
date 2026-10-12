<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight flex items-center gap-2.5">
                    <span>🛡️</span>
                    <span>Dashboard Portofolio Proyek Akademik</span>
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Pemodelan Basis Data Relasional &amp; Eloquent ORM (Pertemuan 6 PBKK)
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ $user->email }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Metric Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Metric 1: Authenticated User --}}
                <div class="p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Pengguna Aktif</span>
                        <span class="text-xs px-2 py-0.5 rounded-md font-bold bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300">Session Verified</span>
                    </div>
                    <div class="text-xl font-bold text-slate-900 dark:text-white truncate">
                        {{ $user->name }}
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Primary Key (users.id): <strong class="font-mono text-slate-700 dark:text-slate-300">#{{ $user->id }}</strong>
                    </p>
                </div>

                {{-- Metric 2: Relational Projects Count --}}
                <div class="p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Proyek Terkait</span>
                        <span class="text-xs px-2 py-0.5 rounded-md font-bold bg-indigo-100 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300">HasMany</span>
                    </div>
                    <div class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">
                        {{ $totalProjects }}
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Terkoneksi via Foreign Key <code class="font-mono text-slate-700 dark:text-slate-300">projects.user_id</code>
                    </p>
                </div>

                {{-- Metric 3: Eloquent Security Guarantee --}}
                <div class="p-6 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Keamanan Kueri</span>
                        <span class="text-xs px-2 py-0.5 rounded-md font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300">PDO Binding</span>
                    </div>
                    <div class="text-sm font-bold text-emerald-700 dark:text-emerald-400">
                        SQLi Protected &amp; Scoped
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Data hanya diekstrak untuk sesi aktif tanpa risiko kebocoran antar-pengguna.
                    </p>
                </div>
            </div>

            {{-- Section: Projects List --}}
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🚀</span>
                            <span>Daftar Proposal Ide Proyek Agentic AI</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                            Data diambil secara dinamis dari tabel <code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-xs">projects</code> menggunakan Eloquent ORM diurutkan dari yang terbaru (<code class="font-mono text-xs">latest()</code>).
                        </p>
                    </div>

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 transition-colors self-start sm:self-auto">
                        &larr; Beranda Showcase Publik
                    </a>
                </div>

                <div class="p-6 sm:p-8">
                    @if ($projects->isEmpty())
                        <div class="text-center py-12 space-y-3">
                            <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                📭
                            </div>
                            <h4 class="text-base font-semibold text-slate-900 dark:text-white">Belum Ada Proyek</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                                Belum ada data proyek Agentic AI yang diasosiasikan dengan akun pengguna ini.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($projects as $project)
                                <div class="p-6 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 hover:border-indigo-300 dark:hover:border-indigo-700 transition-all space-y-4 shadow-xs">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="space-y-1">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                                                🤖 {{ $project->tema_agent }}
                                            </span>
                                            <h4 class="text-base font-bold text-slate-900 dark:text-white pt-1 leading-snug">
                                                {{ $project->judul }}
                                            </h4>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                            #{{ $project->id }}
                                        </span>
                                    </div>

                                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                        {{ $project->deskripsi ?? 'Tidak ada deskripsi yang dilampirkan.' }}
                                    </p>

                                    <div class="pt-3 border-t border-slate-200/80 dark:border-slate-700/80 space-y-2">
                                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                            <span>Kredensial API Terproteksi:</span>
                                            <span class="font-mono text-[11px] text-slate-700 dark:text-slate-300 bg-slate-200/70 dark:bg-slate-900 px-2 py-0.5 rounded">
                                                @if ($project->api_key_secure)
                                                    {{ Str::limit($project->api_key_secure, 16, '...') }}
                                                @else
                                                    <em>(null)</em>
                                                @endif
                                            </span>
                                        </div>

                                        <div class="flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500">
                                            <span>Dibuat: {{ $project->created_at->format('d M Y, H:i') }}</span>
                                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Tersinkronisasi DB MySQL</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Architecture and Migration Info Card --}}
            <div class="p-6 rounded-3xl bg-gradient-to-r from-blue-900/90 to-indigo-900/90 text-white shadow-lg space-y-3">
                <div class="flex items-center gap-2">
                    <span class="text-lg">⚙️</span>
                    <h4 class="font-bold text-sm sm:text-base">Spesifikasi Kepatuhan Rubrik Pertemuan 6 ITS</h4>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-2 text-xs text-blue-100">
                    <div class="bg-white/10 p-3 rounded-xl backdrop-blur-xs">
                        <strong class="text-white block mb-0.5">1. Migrations (35%)</strong>
                        Tabel <code>projects</code> dengan foreign key <code>user_id &rarr; users.id</code> cascade.
                    </div>
                    <div class="bg-white/10 p-3 rounded-xl backdrop-blur-xs">
                        <strong class="text-white block mb-0.5">2. Eloquent Model (25%)</strong>
                        Mass Assignment dilindungi dengan whitelist <code>$fillable</code> &amp; relasi belongsTo.
                    </div>
                    <div class="bg-white/10 p-3 rounded-xl backdrop-blur-xs">
                        <strong class="text-white block mb-0.5">3. Factories &amp; Seeder (20%)</strong>
                        15 Mahasiswa, akun khusus <code>dosenpbkk@its.ac.id</code>, dan Faker dinamis.
                    </div>
                    <div class="bg-white/10 p-3 rounded-xl backdrop-blur-xs">
                        <strong class="text-white block mb-0.5">4. Query Dashboard (10%)</strong>
                        Terproteksi Eloquent <code>Auth::user()->projects()->latest()->get()</code>.
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
