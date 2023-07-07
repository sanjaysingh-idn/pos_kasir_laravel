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
    }
}
