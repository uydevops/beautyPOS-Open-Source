<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        
        
        //fake 20 tane masa olustur içeri bahce teras 

        $tables = ['İçeri', 'Bahçe', 'Teras'];
        for($i = 1; $i <= 20; $i++) {
            \DB::table('tables')->insert([
                'name' => $tables[array_rand($tables)] . ' ' . $i,
                'capacity' => rand(2, 10),
            ]);
        }
        
    }
}
