<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Alat Kesehatan (category_id: 1)
            [
                'name' => 'Tensimeter Digital',
                'description' => 'Tensimeter digital untuk mengukur tekanan darah dengan akurat',
                'price' => 180000,
                'stock' => 15,
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Thermometer Digital',
                'description' => 'Thermometer digital infrared untuk mengukur suhu tubuh',
                'price' => 40000,
                'stock' => 30,
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kursi Roda Travel',
                'description' => 'Kursi roda lipat praktis untuk bepergian',
                'price' => 1300000,
                'stock' => 5,
                'category_id' => 1,
                'is_active' => true,
            ],
            
            // Obat-obatan (category_id: 2)
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Obat penurun panas dan pereda nyeri',
                'price' => 15000,
                'stock' => 100,
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Obat Batuk Herbal',
                'description' => 'Obat batuk dari bahan herbal alami',
                'price' => 25000,
                'stock' => 50,
                'category_id' => 2,
                'is_active' => true,
            ],
            
            // Vitamin & Suplemen (category_id: 3)
            [
                'name' => 'Vitamin C 1000mg',
                'description' => 'Suplemen vitamin C untuk meningkatkan daya tahan tubuh',
                'price' => 75000,
                'stock' => 40,
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Multivitamin Lengkap',
                'description' => 'Multivitamin dengan kandungan lengkap untuk kesehatan optimal',
                'price' => 120000,
                'stock' => 25,
                'category_id' => 3,
                'is_active' => true,
            ],
            
            // Peralatan Medis (category_id: 4)
            [
                'name' => 'Masker N95',
                'description' => 'Masker medis N95 untuk perlindungan maksimal',
                'price' => 50000,
                'stock' => 200,
                'category_id' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Sarung Tangan Latex',
                'description' => 'Sarung tangan latex steril untuk keperluan medis',
                'price' => 35000,
                'stock' => 150,
                'category_id' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Stetoskop Premium',
                'description' => 'Stetoskop professional untuk pemeriksaan medis',
                'price' => 450000,
                'stock' => 10,
                'category_id' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}