<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Alat Kesehatan',
                'description' => 'Berbagai macam alat kesehatan untuk kebutuhan medis',
                'slug' => Str::slug('Alat Kesehatan'),
            ],
            [
                'name' => 'Obat-obatan',
                'description' => 'Obat-obatan untuk berbagai keperluan kesehatan',
                'slug' => Str::slug('Obat-obatan'),
            ],
            [
                'name' => 'Vitamin & Suplemen',
                'description' => 'Vitamin dan suplemen untuk menjaga kesehatan',
                'slug' => Str::slug('Vitamin & Suplemen'),
            ],
            [
                'name' => 'Peralatan Medis',
                'description' => 'Peralatan medis untuk rumah sakit dan klinik',
                'slug' => Str::slug('Peralatan Medis'),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}