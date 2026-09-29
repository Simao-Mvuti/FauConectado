<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $stats = [
            'usuarios' => User::count(),
            'materiais' => Materia::count(),
            'administradores' => User::where('is_admin', true)->count(),
            'tutores' => max(User::count() - 1, 0),
        ];

        $recentMaterials = Materia::latest()->take(5)->get();
        $pendingTutors = User::query()
            ->where('is_admin', false)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentMaterials', 'pendingTutors'));
    }

    public function materiais()
    {
        $this->authorizeAdmin();

        $materiais = Materia::latest()->get();

        return view('admin.materiais', compact('materiais'));
    }

    public function aprovarMateria(Materia $materia): RedirectResponse
    {
        $this->authorizeAdmin();

        $materia->update(['aprovado' => true]);

        return redirect()->route('admin.materiais')->with('success', 'Material aprovado com sucesso.');
    }

    public function tutores()
    {
        $this->authorizeAdmin();

        $tutores = User::where('is_admin', false)->latest()->get();

        return view('admin.tutores', compact('tutores'));
    }

    protected function authorizeAdmin(): void
    {
        $user = Auth::user();

        if (! $user || ! $user->isAdmin()) {
            abort(403, 'Acesso restrito ao painel administrativo.');
        }
    }
}
