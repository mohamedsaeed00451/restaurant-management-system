<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'المشرف',
                'username' => 'admin',
                'is_admin' => true,
                'password' => Hash::make('admin')
            ],
            [
                'name' => 'كاشير 1',
                'username' => 'a1',
                'password' => Hash::make('a1')
            ],
            [
                'name' => 'كاشير 2',
                'username' => 'a2',
                'password' => Hash::make('a2')
            ],
        ];

        foreach ($users as $user) {
            User::query()->create($user);
        }

    }
}
