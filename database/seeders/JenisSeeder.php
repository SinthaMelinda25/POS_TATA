<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis; // <-- Pastikan model Jenis di-import

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyediakan data kategori contoh
        $kategori = [
            ['nama' => 'Makanan'],
            ['nama' => 'Minuman'],
            ['nama' => 'Elektronik'],
            ['nama' => 'Pakaian'],
        ];

        foreach ($kategori as $item) {
            Jenis::create($item);
        }
    }
}
