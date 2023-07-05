<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'role'      => 'admin',
            'password'  => bcrypt('password'),
        ]);

        User::create([
            'name'      => 'kasir',
            'email'     => 'kasir@gmail.com',
            'role'      => 'kasir',
            'password'  => bcrypt('password'),
        ]);

        Category::create([
            'name'      => 'Minuman'
        ]);

        Category::create([
            'name'      => 'Minyak Goreng'
        ]);

        Product::create([
            'name'          => 'Teh Botol Sosro',
            'category'      => 1,
            'desc'          => 'Minuman teh botol sosro',
            'priceBuy'      => 4500,
            'priceSell'     => 5500,
            'stock'         => 24,
            'barcode'       => '26264363636346',
        ]);

        Product::create([
            'name'          => 'Minyak Goreng Filma 1 Liter',
            'category'      => 2,
            'desc'          => 'minyak goreng',
            'priceBuy'      => 21000,
            'priceSell'     => 24000,
            'stock'         => 100,
            'barcode'       => '26264363636332',
        ]);
    }
}
