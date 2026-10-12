<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * Display the Beranda (Home / Dashboard) page.
     */
    public function home(Request $request): View
    {
        $user = $request->query('user');
        $student = config('academic.student');
        $project = config('academic.agent_project');

        return view('pages.home', [
            'user' => $user,
            'student' => $student,
            'project' => $project,
        ]);
    }

    /**
     * Display the Profil Mahasiswa page.
     */
    public function profile(): View
    {
        $student = config('academic.student');

        return view('pages.profile', [
            'student' => $student,
        ]);
    }

    /**
     * Display the Ide Agent / Ide Riset page.
     */
    public function idea(Request $request): View
    {
        $mode = $request->query('mode');
        $isDark = ($mode === 'dark');
        $project = config('academic.agent_project');

        return view('pages.idea', [
            'project' => $project,
            'mode' => $mode,
            'isDark' => $isDark,
        ]);
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
            ->with('success', 'Ide riset "' . $validated['title'] . '" berhasil dikirimkan! Tim pengembang akan meninjau konsep inovasi Anda.');
    }
}
