<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->delete();

        $employees = [
            [
                'name' => 'mohamed',
                'phone' => '01010101010',
                'salary' => 200,
            ],
            [
                'name' => 'ahmed',
                'phone' => '01020202020',
                'salary' => 200,
            ],
            [
                'name' => 'ali',
                'phone' => '01030303030',
                'salary' => 200,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::query()->create($employee);
        }
    }
}
