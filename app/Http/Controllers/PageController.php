<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the Beranda (Home / Dashboard) page.
     */
    public function home(Request $request): View
    {
        $user = $request->query('user');
        $isMikail = $this->isMikailAccount();
        $currentUser = Auth::user();
        $userProjects = $currentUser ? $currentUser->projects()->latest()->get() : collect();

        if ($isMikail) {
            $student = config('academic.student');
            $project = config('academic.agent_project');
        } else {
            $student = $this->buildUserStudentData();
            $project = [
                'title' => 'Daftar Proyek '.($currentUser?->name ?? 'Pengguna'),
                'subtitle' => 'Portofolio Proyek Agentic AI',
                'description' => 'Koleksi proposal dan proyek penelitian AI yang terdaftar pada akun Anda.',
                'repository' => 'https://github.com/its-pbkk',
            ];
        }

        return view('pages.home', [
            'user' => $user,
            'student' => $student,
            'project' => $project,
            'isMikail' => $isMikail,
            'userProjects' => $userProjects,
        ]);
    }

    /**
     * Display the Profil Mahasiswa page.
     */
    public function profile(): View
    {
        $isMikail = $this->isMikailAccount();
        $currentUser = Auth::user();
        $userProjects = $currentUser ? $currentUser->projects()->latest()->get() : collect();

        if ($isMikail) {
            $student = config('academic.student');
        } else {
            $student = $this->buildUserStudentData();
        }

        return view('pages.profile', [
            'student' => $student,
            'isMikail' => $isMikail,
            'userProjects' => $userProjects,
            'currentUser' => $currentUser,
        ]);
    }

    /**
     * Display the Ide Agent / Ide Riset page.
     */
    public function idea(Request $request): View
    {
        $mode = $request->query('mode');
        $isDark = ($mode === 'dark');
        $isMikail = $this->isMikailAccount();
        $currentUser = Auth::user();
        $userProjects = $currentUser ? $currentUser->projects()->latest()->get() : collect();

        if ($isMikail) {
            $project = config('academic.agent_project');
        } else {
            $project = [
                'title' => 'Ide Proyek Agentic AI Milik '.($currentUser?->name ?? 'Pengguna'),
                'short_title' => 'Ide Proyek AI',
                'subtitle' => 'Eksplorasi Ide Agen Otonom & Model Bahasa',
                'description' => 'Berikut adalah daftar ide riset dan proposal Agentic AI yang Anda miliki di basis data.',
                'type' => 'Daftar Proyek Pengguna',
                'status' => 'Tersimpan di Basis Data MySQL',
            ];
        }

        return view('pages.idea', [
            'project' => $project,
            'mode' => $mode,
            'isDark' => $isDark,
            'isMikail' => $isMikail,
            'userProjects' => $userProjects,
        ]);
    }

    /**
     * Check whether the currently authenticated user is Mikail.
     */
    private function isMikailAccount(): bool
    {
        $user = Auth::user();
        if (! $user) {
            return false;
        }

        return $user->email === (config('academic.student.email') ?? '5025241046@student.its.ac.id');
    }

    /**
     * Build a minimal student profile array from the authenticated User model.
     */
    private function buildUserStudentData(): array
    {
        /** @var User $user */
        $user = Auth::user();

        $words = preg_split('/\s+/', trim($user->name ?? 'User'));
        $initials = '';
        if (! empty($words[0])) {
            $initials .= mb_substr($words[0], 0, 1);
        }
        if (isset($words[1]) && ! empty($words[1])) {
            $initials .= mb_substr($words[1], 0, 1);
        } elseif (mb_strlen($words[0] ?? '') > 1) {
            $initials .= mb_substr($words[0], 1, 1);
        }
        $initials = strtoupper($initials ?: 'U');

        return [
            'name' => $user->name,
            'email' => $user->email,
            'nrp' => 'ID Pengguna #'.$user->id,
            'headline' => 'Mahasiswa / Pengguna Terdaftar · Akun PBKK',
            'specialty' => 'Pengembangan Aplikasi Web & Agentic AI',
            'program' => 'Departemen Teknik Informatika',
            'department' => 'Teknik Informatika',
            'faculty' => 'FTEIC',
            'university' => 'Institut Teknologi Sepuluh Nopember (ITS)',
            'semester' => 'Semester 5 (Gasal 2026/2027)',
            'class' => 'PBKK',
            'academic_year' => '2026/2027',
            'lecturer' => 'Dosen Pengampu PBKK',
            'avatar_initials' => $initials,
            'bio' => 'Pengguna terdaftar pada Portal Akademik dan Pemodelan Basis Data PBKK Pertemuan 6.',
            'competencies_soft' => [],
            'competencies_technical' => [],
            'courses' => [],
            'achievements' => [],
        ];
    }

    /**
     * Handle the Idea submission form.
     */
    public function submitIdea(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'category' => ['required', 'string', 'in:Autonomous Agents,LLM Orchestration,Student Productivity,Academic Advising,Other'],
            'description' => ['required', 'string', 'min:15', 'max:2000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'title.required' => 'Judul ide riset wajib diisi.',
            'title.min' => 'Judul ide riset minimal 5 karakter.',
            'title.max' => 'Judul ide riset maksimal 200 karakter.',
            'category.required' => 'Kategori ide wajib dipilih.',
            'category.in' => 'Kategori ide tidak valid.',
            'description.required' => 'Deskripsi ide riset wajib diisi.',
            'description.min' => 'Deskripsi ide riset minimal 15 karakter agar informatif.',
        ]);

        $modeParam = $request->input('_mode') === 'dark' ? ['mode' => 'dark'] : [];

        return redirect()
            ->route('idea', $modeParam)
            ->with('success', 'Ide riset "'.$validated['title'].'" berhasil dikirimkan! Tim pengembang akan meninjau konsep inovasi Anda.');
    }
}
