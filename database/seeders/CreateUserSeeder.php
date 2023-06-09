<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =       [
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('12345'),
                'role' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345'),
                'role' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            $newUser = User::create($user);
            if ($newUser->role == 'customer') {
                $newUser->points()->create([
                    'points' => 200
                ]);
            }
        }
    }
}
