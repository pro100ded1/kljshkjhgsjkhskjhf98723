<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Orchid\Platform\Models\Role;
use Orchid\Platform\Models\User as OrchidUser;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Создаем системные роли для Orchid
        Role::firstOrCreate([
            'slug' => 'admin',
            'name' => 'Admin',
        ]);

        Role::firstOrCreate([
            'slug' => 'operator',
            'name' => 'Operator',
        ]);

        // 2. Создаем администратора через Orchid
        OrchidUser::updateOrCreate(
            ['email' => 'admin@viatax.ru'],
            [
                'name' => 'pro100ded',
                'password' => Hash::make('12wq12wq'),
                'permissions' => ['platform.*'] // Полные права
            ]
        )->roles()->sync([Role::where('slug', 'admin')->first()->id]);

        // 3. Создаем оператора через Orchid
        OrchidUser::updateOrCreate(
            ['email' => 'operator@viatax.ru'],
            [
                'name' => 'Operator',
                'password' => Hash::make('12wq12wq'),
                'permissions' => ['platform.systems.roles'] // Пример ограниченных прав
            ]
        )->roles()->sync([Role::where('slug', 'operator')->first()->id]);

        // 4. Тестовые пользователи (отдельная таблица)
        User::factory(10)->create([
            'role' => 'passenger',
            'password' => Hash::make('password')
        ]);
    }
}