<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $year = new Year;
        foreach(['active' => 2024, 'selected' => 2024,] as $key => $value)
        $year->{$key} = $value;
        $year->save();
    }
}
