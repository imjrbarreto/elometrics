<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $totalWorkspaces = $user->workspaces()->count();

        $activeWorkspaces = $user->workspaces()
    ->where('status', 'active')
    ->count();

        $joinedWorkspaces = $user->joinedWorkspaces()->count();

        $upcomingSessions = TrainingSession::query()
            ->whereHas('workspace', function ($query) use ($user) {
                $query->accessibleTo($user)
                    ->where('status', 'active');
            })
            ->where('status', 'scheduled')
            ->where('date', '>=', now())
            ->with('workspace')
            ->orderBy('date')
            ->paginate(5);

        return view('dashboard', compact(
            'totalWorkspaces',
            'activeWorkspaces',
            'joinedWorkspaces',
            'upcomingSessions',
        ));
    }
}