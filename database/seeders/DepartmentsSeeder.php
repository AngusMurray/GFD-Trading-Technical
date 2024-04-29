<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Sales'],
            ['name' => 'Order processing'],
            ['name' => 'Support'],
        ])->each(function ($department){
            Department::create($department);
        });
    }
}
