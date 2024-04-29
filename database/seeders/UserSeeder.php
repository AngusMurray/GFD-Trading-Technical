<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        collect([
            ['name' => 'Management User', 'email' => 'management.user@company.co.uk', 'email_verified_at' => now(), 'password' => static::$password ??= Hash::make('qwerty123'), 'department_id' => Department::inRandomOrder()->first()->id, 'isManagement' => true]
        ])->each(function ($seed){
            User::create($seed);
        });
    }
}
