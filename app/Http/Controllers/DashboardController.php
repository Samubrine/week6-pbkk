<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's project dashboard.
     *
     * Rubrik Pertemuan 6 (Integritas Query di Dashboard):
     * - Hanya menarik data project milik user yang sedang aktif login.
     * - Diurutkan berdasarkan tanggal terbaru (latest / created_at desc).
     * - Aman dari SQL Injection melalui Eloquent Parameter Binding.
     */
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Eloquent query strictly scoped to logged-in user and sorted by newest
        $projects = $user->projects()
            ->latest()
            ->get();

        return view('dashboard', [
            'user' => $user,
            'projects' => $projects,
            'totalProjects' => $projects->count(),
        ]);
    }
}
