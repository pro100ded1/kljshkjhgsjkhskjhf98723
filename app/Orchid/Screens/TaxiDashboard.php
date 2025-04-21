<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class TaxiDashboard extends Screen
{
    public function name(): string
    {
        return 'Такси-Панель';
    }

    public function query(): array
    {
        return [
            'stats' => [
                'total_users' => User::count(),
                'drivers' => User::where('role', 'driver')->count(),
                'passengers' => User::where('role', 'passenger')->count(),
            ],
            'users' => User::latest()->take(5)->get(),
            'registrationDates' => User::groupBy('date')
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->pluck('date')
                ->toArray(),
            'registrationCounts' => User::groupBy('date')
                ->selectRaw('COUNT(*) as count')
                ->pluck('count')
                ->toArray()
        ];
    }

    public function layout(): array
    {
        return [Layout::view('admin.taxi-dashboard')];
    }
}