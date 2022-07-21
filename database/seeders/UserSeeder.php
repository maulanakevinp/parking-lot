<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        User::truncate();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@parking-lot.com',
        ])->assignRole('admin');
        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
