<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authoritative Student Academic Profile
    |--------------------------------------------------------------------------
    | Configured according to authoritative student information.
    | Specialty: System Architecture
    */
    'student' => [
        'name' => env('STUDENT_NAME', 'Mikail Ibrahim Hakim'),
        'nrp' => env('STUDENT_NRP', '5025241046'),
        'headline' => 'Computer Science Student · System Architecture',
        'specialty' => 'System Architecture',
        'program' => env('STUDENT_PROGRAM', 'S1 Teknik Informatika'),
        'department' => 'Departemen Teknik Informatika',
        'faculty' => 'Fakultas Teknologi Elektro dan Informatika Cerdas (FTEIC)',
        'university' => 'Institut Teknologi Sepuluh Nopember (ITS)',
        'semester' => 'Semester 5 (Gasal 2026/2027)',
        'class' => 'PBKK - A',
        'academic_year' => '2026/2027',
        'lecturer' => 'Dosen Pengampu PBKK',
        'email' => env('STUDENT_EMAIL', '5025241046@student.its.ac.id'),
        'github' => env('STUDENT_GITHUB', 'https://github.com/samubrine'),
        'linkedin' => env('STUDENT_LINKEDIN', 'https://linkedin.com/in/mikailibraa'),
        'avatar_initials' => 'MI',
        'bio' => 'Computer Science student with a growing focus on system architecture, organizational strategy, and applied AI. Interested in System Architecture and the design of structured, scalable systems. Currently developing the Security Agent Harness, a local-first agentic security investigation system.',
        
        // Competencies categorized cleanly without arbitrary percentages
        'competencies_soft' => [
            ['name' => 'Public Speaking', 'level' => 'Core', 'desc' => 'Komunikasi publik, presentasi teknis, dan penyampaian gagasan secara persuasif.'],
            ['name' => 'Basic Administration', 'level' => 'Standard', 'desc' => 'Pengelolaan berkas administratif, korespondensi, dan tata laksana organisasi.'],
            ['name' => 'Organization Management', 'level' => 'Core', 'desc' => 'Pengorganisasian tim, koordinasi kegiatan, dan kepemimpinan kerja bersama.'],
            ['name' => 'Strategic Alignment', 'level' => 'Applied', 'desc' => 'Penyelarasan visi proyek dan kebutuhan organisasi dengan eksekusi teknis.'],
        ],

        'competencies_technical' => [
            ['name' => 'System Architecture', 'level' => 'Specialty & Focus', 'desc' => 'Tertarik pada perancangan sistem terstruktur, pembagian bounded context, dan skalabilitas arsitektur.'],
            ['name' => 'AI Implementation in Businesses / Organizations', 'level' => 'Applied', 'desc' => 'Penerapan solusi kecerdasan buatan praktis untuk otomatisasi alur kerja organisasi dan bisnis.'],
            ['name' => 'Basic Agentic AI Skills', 'level' => 'Fundamental', 'desc' => 'Keahlian dasar dalam perancangan harness, orchestrasi tool/LLM, dan evaluasi agen otonom.'],
        ],

        // Authoritative 8 Courses with exact correct spelling
        'courses' => [
            ['name' => 'Tata Kelola Teknologi Informasi', 'category' => 'Manajemen & Tata Kelola IT', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Sistem Terdistribusi', 'category' => 'Arsitektur & Infrastruktur', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Rekayasa Sistem Berbasis Pengetahuan', 'category' => 'Kecerdasan Buatan & Knowledge Base', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Pemrograman Berbasis Kerangka Kerja', 'category' => 'Rekayasa Perangkat Lunak Terapan', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Pemodelan dan Simulasi', 'category' => 'Komputasi & Analisis Sistem', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Grafika Komputer', 'category' => 'Visual Computing & Rendering', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Keamanan Informasi', 'category' => 'Keamanan Siber & Kriptografi', 'status' => 'Sedang Ditempuh'],
            ['name' => 'Sistem Enterprise', 'category' => 'Arsitektur Sistem Skala Besar', 'status' => 'Sedang Ditempuh'],
        ],

        // Authoritative Achievements (both consistently formatted with em dash —)
        'achievements' => [
            [
                'title' => 'Finalis GEMASTIK 2026 — Karya Tulis Ilmiah',
                'category' => 'Kompetisi Ilmiah Nasional',
                'badge' => 'GEMASTIK 2026',
                'desc' => 'Berhasil lolos sebagai finalis pada kategori Karya Tulis Ilmiah (KTI) dalam ajang Pagelaran Mahasiswa Nasional Bidang Teknologi Informasi dan Komunikasi (GEMASTIK) 2026.'
            ],
            [
                'title' => 'Founder of KIBRA Shop — ~2K MRR',
                'category' => 'Digital Venture',
                'badge' => '~2K MRR',
                'desc' => 'Mendirikan dan mengembangkan usaha digital KIBRA Shop dengan traksi operasional mencapai kisaran ~2K MRR.'
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authoritative Agentic AI Project: Security Agent Harness
    |--------------------------------------------------------------------------
    | Repository: https://github.com/Samubrine/security-agent-harness
    | Type: Command-Line Application (CLI) & Agentic Harness (Local-First)
    */
    'agent_project' => [
        'title' => 'Security Agent Harness',
        'short_title' => 'Security Agent Harness',
        'subtitle' => 'Local-first Agentic Security Investigation Harness',
        'tagline' => 'A local-first agentic security investigation harness that combines LLM-driven investigation planning with a deterministic and auditable execution runtime.',
        'description' => 'A local-first agentic security investigation harness that combines LLM-driven investigation planning with a deterministic and auditable execution runtime. The Security Agent Harness allows a locally hosted model to propose what information is needed during a security investigation, while the harness retains deterministic control over tool execution, policy, provider selection, scope enforcement, evidence handling, and replay.',
        'repository' => 'https://github.com/Samubrine/security-agent-harness',
        'repository_display' => 'github.com/Samubrine/security-agent-harness',
        'type' => 'CLI Application & Investigation Harness',
        'status' => 'Functional Vertical Slice (Active Development)',
        'version' => 'v0.1.0-slice',
        
        'problem' => 'Investigasi insiden keamanan sering kali terhambat oleh keharusan memilih antara analisis manual yang lambat atau otomasi AI "black-box" yang tidak terkendali, berisiko melanggar batas otorisasi (out-of-scope), dan sulit diaudit ulang.',
        
        'objective' => 'Menghadirkan harness investigasi keamanan berbasis model lokal yang memungkinkan LLM mengusulkan kebutuhan analisis (probabilistic brain), sementara harness memegang kontrol mutlak atas izin eksekusi, penegakan kebijakan, pemilihan provider tools, penanganan artefak bukti, dan auditabilitas replay (deterministic spine).',

        // Core conceptual architectural pillars
        'pillars' => [
            [
                'name' => 'Probabilistic Brain',
                'subtitle' => 'Investigation Planning & Hypothesis',
                'badge' => 'Local LLM',
                'color' => 'indigo',
                'description' => 'Model LLM yang dijalankan secara lokal (local-first) menganalisis konteks insiden dan mengusulkan typed capability proposal mengenai informasi apa yang dibutuhkan berikutnya.',
            ],
            [
                'name' => 'Deterministic Spine',
                'subtitle' => 'Policy, Gate & Execution Control',
                'badge' => 'Runtime Harness',
                'color' => 'blue',
                'description' => 'Harness memvalidasi apakah pemanggilan tool benar-benar diperlukan (necessity gate), memverifikasi batasan scope/kebijakan, mengisolasi eksekusi, serta mencatat artefak bukti untuk audit.',
            ],
        ],

        // Simplified, accurate architecture pipeline
        'architecture_steps' => [
            ['step' => '01', 'name' => 'User / Investigation Objective', 'role' => 'Tujuan investigasi atau insiden yang didefinisikan pengguna dimasukkan ke harness.'],
            ['step' => '02', 'name' => 'Local LLM / Planner', 'role' => 'Model bahasa lokal merumuskan hipotesis investigasi dan mengusulkan aksi lanjutan.'],
            ['step' => '03', 'name' => 'Typed Capability Proposal', 'role' => 'Perencanaan diterjemahkan menjadi usulan kapabilitas yang bertipe data ketat.'],
            ['step' => '04', 'name' => 'Necessity Gate', 'role' => 'Pintu gerbang deterministik mengevaluasi apakah panggilan tool sungguh diperlukan.'],
            ['step' => '05', 'name' => 'Policy & Scope Enforcement', 'role' => 'Memastikan aksi tidak melanggar batasan izin, aturan keamanan, maupun target scope.'],
            ['step' => '06', 'name' => 'Provider Router', 'role' => 'Mengarahkan pemanggilan ke Skills, Native Tools, atau MCP Providers yang berwenang.'],
            ['step' => '07', 'name' => 'Artifacts & Observations', 'role' => 'Menyimpan raw output dan bukti hasil eksekusi ke repositori artefak immutable.'],
            ['step' => '08', 'name' => 'Parsers & Analysers', 'role' => 'Mengekstrak fakta terstruktur dari data log dan respon pengamatan keamanan.'],
            ['step' => '09', 'name' => 'Structured Findings', 'role' => 'Mengonsolidasikan temuan investigasi dengan tingkat keyakinan yang dapat dipertanggungjawabkan.'],
            ['step' => '10', 'name' => 'Report, Replay & Verification', 'role' => 'Menghasilkan laporan komprehensif yang dapat di-replay ulang untuk verifikasi ground truth.'],
        ],

        // Truthful key features derived from repository
        'features' => [
            [
                'title' => 'Local-First Model Execution',
                'desc' => 'Dijalankan sepenuhnya di lingkungan lokal pengguna tanpa ketergantungan API pihak ketiga yang membocorkan data sensitif investigasi.',
                'icon' => 'cpu',
            ],
            [
                'title' => 'Deterministic Runtime & Gate',
                'desc' => 'Harness memiliki kendali penuh melalui necessity gate untuk menyaring apakah suatu pemanggilan tool benar-benar dibutuhkan.',
                'icon' => 'check',
            ],
            [
                'title' => 'Typed Capability Proposals',
                'desc' => 'Permintaan aksi dari LLM diformat sebagai proposal bertipe ketat, mencegah halusinasi parameter dan ketidakpastian parsing.',
                'icon' => 'code',
            ],
            [
                'title' => 'Policy & Scope Enforcement',
                'desc' => 'Aturan ketat membatasi jangkauan aksi investigasi, menjamin tidak ada aksi di luar batas otorisasi yang telah disepakati.',
                'icon' => 'academic',
            ],
            [
                'title' => 'Skills, Native Tools & MCP',
                'desc' => 'Organisasi kapabilitas modular yang dapat memanggil skill lokal, tool biner native, maupun penyedia protokol MCP standar.',
                'icon' => 'sparkles',
            ],
            [
                'title' => 'Artifact-Backed Evidence & Replay',
                'desc' => 'Semua observasi dicatat sebagai artefak bukti yang dapat di-replay secara deterministik untuk validasi evaluasi ground truth.',
                'icon' => 'book',
            ],
        ],

        // Controlled safety notice
        'safety_notice' => 'Security Agent Harness adalah harness investigasi keamanan defensif lokal berbasis CLI dengan pembatasan scope struktural dan eksekusi terverifikasi. Sistem ini tidak melakukan eksploitasi ofensif otonom, peretasan tanpa izin, maupun penyebaran malware.',
    ],
];
