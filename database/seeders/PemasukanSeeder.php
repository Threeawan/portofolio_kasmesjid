<?php

namespace Database\Seeders;

use App\Models\Pemasukan\Pemasukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemasukan = [
            ['title' => 'Tugas 1', 'due_date' => Pemasukan::now()->subDays(5)],
            ['title' => 'Tugas 2', 'due_date' => Pemasukan::now()->subDays(2)],
            ['title' => 'Tugas 3', 'due_date' => Pemasukan::now()->addDays(3)],
            ['title' => 'Tugas 4', 'due_date' => Pemasukan::now()->addDays(10)],        
        ];

        foreach ($pemasukan as $pemasukan) {
            Pemasukan::create($pemasukan);
        }
    }
}
