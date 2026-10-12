<!DOCTYPE html>
<html lang="id" class="h-full antialiased scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal Profil Akademik Mahasiswa dan Showcase Security Agent Harness - PBKK Pertemuan 4 Departemen Teknik Informatika ITS">

    <title>@yield('title', 'Portal Profil Akademik PBKK') - Institut Teknologi Sepuluh Nopember</title>

    {{-- Favicon / Brand Symbol --}}
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>">

    {{-- Frontend Asset Pipeline via Vite (No Raw CDN Links) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
@php
    $isDarkMode = (request()->query('mode') === 'dark') || (isset($isDark) && $isDark);
    $bodyBg = $isDarkMode ? 'bg-slate-950 text-slate-100' : 'bg-slate-50 text-slate-800';
    $headerBg = $isDarkMode ? 'bg-slate-900/95 border-slate-800/90 text-slate-100 shadow-md backdrop-blur-md' : 'bg-white/95 border-slate-200/80 text-slate-800 shadow-xs backdrop-blur-md';
    $brandTitle = $isDarkMode ? 'text-white' : 'text-slate-900';
    $brandSub = $isDarkMode ? 'text-slate-400' : 'text-slate-500';
    $footerBg = $isDarkMode ? 'bg-slate-900 border-slate-800 text-slate-300' : 'bg-white border-slate-200 text-slate-600';
    $footerHead = $isDarkMode ? 'text-white' : 'text-slate-900';
    $footerSub = $isDarkMode ? 'text-slate-400' : 'text-slate-600';
    $footerBorder = $isDarkMode ? 'border-slate-800' : 'border-slate-100';
    $footerLink = $isDarkMode ? 'bg-slate-800 hover:bg-slate-700 text-slate-200' : 'bg-slate-100 hover:bg-slate-200 text-slate-700';
    $mobileMenuBg = $isDarkMode ? 'bg-slate-900 border-slate-800 text-slate-100' : 'bg-white border-slate-100 text-slate-800';

    $isHomeActive = request()->routeIs('home*') || request()->is('/') || request()->is('beranda');
    $isProfileActive = request()->routeIs('mahasiswa.profile*') || request()->is('profil-mahasiswa');
    $isIdeaActive = request()->routeIs('idea*') || request()->is('ide-agent');
@endphp
<body class="min-h-full flex flex-col font-sans selection:bg-blue-600 selection:text-white transition-colors duration-200 {{ $bodyBg }}">
    {{-- Global Academic Header / Navbar --}}
    <header class="sticky top-0 z-50 transition-colors duration-200 border-b {{ $headerBg }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-18">
                {{-- Brand & Institutional Identity --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl p-1">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-gradient-to-tr from-blue-700 via-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md font-bold text-lg group-hover:scale-105 transition-transform shrink-0">
                            ITS
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm sm:text-base font-bold tracking-tight leading-none group-hover:text-blue-600 transition-colors {{ $brandTitle }}">
                                PBKK • Profil Akademik
                            </span>
                            <span class="text-[11px] sm:text-xs font-medium mt-1 {{ $brandSub }}">
                                Teknik Informatika ITS • {{ Auth::user()?->name ?? 'Mikail Ibrahim Hakim' }}
                            </span>
                        </div>
                    </a>
                </div>

                {{-- Desktop Navigation Links --}}
                <nav class="hidden md:flex items-center gap-1.5" aria-label="Navigasi Utama">
                    <a href="{{ route('home') }}"
                       class="px-3.5 py-2 rounded-xl text-sm font-medium transition-all {{ $isHomeActive ? ($isDarkMode ? 'bg-slate-800 text-cyan-300 font-semibold shadow-xs border border-cyan-800/40' : 'bg-blue-50 text-blue-700 font-semibold shadow-xs') : ($isDarkMode ? 'text-slate-300 hover:text-white hover:bg-slate-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100') }}">
                        Beranda
                    </a>

                    <a href="{{ route('mahasiswa.profile') }}"
                       class="px-3.5 py-2 rounded-xl text-sm font-medium transition-all {{ $isProfileActive ? ($isDarkMode ? 'bg-slate-800 text-cyan-300 font-semibold shadow-xs border border-cyan-800/40' : 'bg-blue-50 text-blue-700 font-semibold shadow-xs') : ($isDarkMode ? 'text-slate-300 hover:text-white hover:bg-slate-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100') }}">
                        Profil Mahasiswa
                    </a>

                    <a href="{{ route('idea', $isDarkMode ? ['mode' => 'dark'] : []) }}"
                       class="px-3.5 py-2 rounded-xl text-sm font-medium transition-all flex items-center gap-2 {{ $isIdeaActive ? ($isDarkMode ? 'bg-cyan-950 text-cyan-300 font-semibold shadow-xs border border-cyan-700/50' : 'bg-indigo-50 text-indigo-700 font-semibold shadow-xs') : ($isDarkMode ? 'text-slate-300 hover:text-white hover:bg-slate-800' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100') }}">
                        <span>Ide Agent</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold {{ $isDarkMode ? 'bg-cyan-900/60 text-cyan-200 border border-cyan-700/60' : 'bg-indigo-100 text-indigo-800 border border-indigo-200' }}">
                            CLI Harness
                        </span>
                    </a>
                </nav>

                {{-- Quick Theme Switcher & Actions --}}
                <div class="hidden md:flex items-center gap-3">
                    {{-- Global Mode Switcher --}}
                    @if (request()->routeIs('idea*') || request()->is('ide-agent*'))
                        <div class="inline-flex items-center p-1 rounded-xl border {{ $isDarkMode ? 'bg-slate-800 border-slate-700' : 'bg-slate-100 border-slate-200' }}">
                            <a href="{{ route('idea') }}"
                               title="Tampilan Light Mode"
                               class="px-2.5 py-1 rounded-lg text-xs font-semibold flex items-center gap-1 transition-all {{ !$isDarkMode ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-400 hover:text-slate-200' }}">
                                <span>☀️</span>
                                <span class="hidden lg:inline">Light</span>
                            </a>
                            <a href="{{ route('idea', ['mode' => 'dark']) }}"
                               title="Tampilan Dark Mode"
                               class="px-2.5 py-1 rounded-lg text-xs font-semibold flex items-center gap-1 transition-all {{ $isDarkMode ? 'bg-cyan-950 text-cyan-300 shadow-xs border border-cyan-700/50' : 'text-slate-600 hover:text-slate-900' }}">
                                <span>🌙</span>
                                <span class="hidden lg:inline">Dark</span>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('idea', ['mode' => 'dark']) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $isDarkMode ? 'bg-cyan-950 text-cyan-300 border border-cyan-700/50' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200' }}">
                            <span>🌙</span>
                            <span>Dark Mode</span>
                        </a>
                    @endif

                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-700 text-white transition-colors shadow-xs">
                            <span>🛡️</span> Dashboard
                        </a>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold {{ $isDarkMode ? 'bg-slate-800 text-slate-200 border border-slate-700' : 'bg-slate-100 text-slate-700 border border-slate-200' }}">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        PBKK W6
                    </span>
                </div>

                {{-- Mobile Menu & Theme Toggle Button --}}
                <div class="flex items-center gap-2 md:hidden">
                    <a href="{{ route('idea', $isDarkMode ? [] : ['mode' => 'dark']) }}"
                       class="p-2 rounded-xl text-xs font-semibold border transition-all {{ $isDarkMode ? 'bg-slate-800 border-slate-700 text-cyan-300' : 'bg-slate-100 border-slate-200 text-slate-700' }}"
                       title="Toggle Dark Mode">
                        <span>{{ $isDarkMode ? '☀️' : '🌙' }}</span>
                    </a>

                    <button type="button" id="mobile-menu-btn" aria-expanded="false" aria-label="Toggle navigation" class="p-2.5 rounded-xl border text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors {{ $isDarkMode ? 'bg-slate-800 border-slate-700 text-slate-200 hover:bg-slate-700' : 'bg-slate-50 border-slate-200' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Dropdown Menu --}}
            <div id="mobile-menu" class="hidden md:hidden pb-5 pt-3 border-t space-y-1.5 {{ $mobileMenuBg }}">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ $isHomeActive ? ($isDarkMode ? 'bg-slate-800 text-cyan-300 font-semibold' : 'bg-blue-50 text-blue-700 font-semibold') : ($isDarkMode ? 'text-slate-300 hover:bg-slate-800' : 'text-slate-600 hover:bg-slate-100') }}">
                    <span class="text-base">🏠</span>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('mahasiswa.profile') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ $isProfileActive ? ($isDarkMode ? 'bg-slate-800 text-cyan-300 font-semibold' : 'bg-blue-50 text-blue-700 font-semibold') : ($isDarkMode ? 'text-slate-300 hover:bg-slate-800' : 'text-slate-600 hover:bg-slate-100') }}">
                    <span class="text-base">🎓</span>
                    <span>Profil Mahasiswa</span>
                </a>
                <a href="{{ route('idea', $isDarkMode ? ['mode' => 'dark'] : []) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all {{ $isIdeaActive ? ($isDarkMode ? 'bg-cyan-950 text-cyan-300 font-semibold' : 'bg-indigo-50 text-indigo-700 font-semibold') : ($isDarkMode ? 'text-slate-300 hover:bg-slate-800' : 'text-slate-600 hover:bg-slate-100') }}">
                    <div class="flex items-center gap-3">
                        <span class="text-base">🛡️</span>
                        <span>Ide Agent (Security Harness)</span>
                    </div>
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded {{ $isDarkMode ? 'bg-cyan-900 text-cyan-200' : 'bg-indigo-100 text-indigo-800' }}">
                        CLI
                    </span>
                </a>
                <div class="pt-2 border-t {{ $isDarkMode ? 'border-slate-800' : 'border-slate-100' }} flex items-center justify-between px-3.5 text-xs">
                    <span class="{{ $isDarkMode ? 'text-slate-400' : 'text-slate-500' }}">Mode Tampilan:</span>
                    <a href="{{ route('idea', $isDarkMode ? [] : ['mode' => 'dark']) }}" class="font-semibold underline {{ $isDarkMode ? 'text-cyan-300' : 'text-blue-700' }}">
                        {{ $isDarkMode ? 'Beralih ke Light Mode ☀️' : 'Beralih ke Dark Mode 🌙' }}
                    </a>
                </div>
                <div class="pt-2 border-t {{ $isDarkMode ? 'border-slate-800' : 'border-slate-100' }} px-3.5 space-y-1.5">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold {{ $isDarkMode ? 'bg-indigo-900 text-indigo-200' : 'bg-indigo-50 text-indigo-700' }}">
                            <span class="text-base">🛡️</span>
                            <span>Dashboard</span>
                        </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content Container (Inherited by Child Views via @section('content')) --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ITS Academic Identity Footer --}}
    <footer class="mt-auto border-t transition-colors duration-200 {{ $footerBg }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8 border-b {{ $footerBorder }}">
                {{-- Column 1: ITS & Department --}}
                <div class="space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-700 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                            ITS
                        </div>
                        <div>
                            <h5 class="text-xs sm:text-sm font-bold uppercase tracking-wider leading-tight {{ $footerHead }}">
                                Institut Teknologi Sepuluh Nopember
                            </h5>
                            <span class="text-[11px] {{ $footerSub }}">FTEIC • Departemen Teknik Informatika</span>
                        </div>
                    </div>
                    <p class="text-xs leading-relaxed {{ $footerSub }}">
                        Gedung Teknik Informatika, Kampus ITS Sukolilo, Surabaya 60111.<br>
                        Fokus: <strong>System Architecture</strong> &amp; Applied AI.
                    </p>
                </div>

                {{-- Column 2: Mata Kuliah & Tugas --}}
                <div class="space-y-3">
                    <h5 class="text-xs sm:text-sm font-bold uppercase tracking-wider {{ $footerHead }}">
                        Mata Kuliah &amp; Tugas
                    </h5>
                    <p class="text-xs leading-relaxed {{ $footerSub }}">
                        <strong>Pemrograman Berbasis Kerangka Kerja (PBKK)</strong><br>
                        Tugas 6: Secure Academic Portal Database &amp; Eloquent Modeling<br>
                        Teknologi: Laravel 11/12 • Blade • Tailwind CSS • Vite
                    </p>
                </div>

                {{-- Column 3: Tautan Cepat & Status --}}
                <div class="space-y-3">
                    <h5 class="text-xs sm:text-sm font-bold uppercase tracking-wider {{ $footerHead }}">
                        Navigasi &amp; Tantangan
                    </h5>
                    <div class="flex flex-wrap gap-2 text-xs">
                        <a href="{{ route('home') }}" class="px-2.5 py-1.5 rounded-lg transition-colors {{ $footerLink }}">Beranda</a>
                        <a href="{{ route('mahasiswa.profile') }}" class="px-2.5 py-1.5 rounded-lg transition-colors {{ $footerLink }}">Profil Mahasiswa</a>
                        <a href="{{ route('idea') }}" class="px-2.5 py-1.5 rounded-lg transition-colors {{ $footerLink }}">Ide Agent (Light)</a>
                        <a href="{{ route('idea', ['mode' => 'dark']) }}" class="px-2.5 py-1.5 rounded-lg transition-colors font-semibold {{ $isDarkMode ? 'bg-cyan-950 text-cyan-300 border border-cyan-800' : 'bg-slate-900 text-slate-100 hover:bg-slate-800' }}">🌙 Dark Mode</a>
                    </div>
                </div>
            </div>

            {{-- Bottom copyright line --}}
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs {{ $footerSub }}">
                <p>&copy; 2026 {{ Auth::user()?->name ?? 'Mikail Ibrahim Hakim' }} • Departemen Teknik Informatika ITS. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-3">
                    <span>Arsitektur MVC &amp; Blade Components</span>
                    <span>•</span>
                    <a href="https://github.com/Samubrine/security-agent-harness" target="_blank" rel="noopener noreferrer" class="hover:underline font-semibold {{ $isDarkMode ? 'text-cyan-300' : 'text-blue-700' }}">
                        GitHub: security-agent-harness &rarr;
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Interactive Vanilla Mobile Menu Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    const isHidden = menu.classList.contains('hidden');
                    menu.classList.toggle('hidden');
                    btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
