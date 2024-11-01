<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Faker instance
        $faker = Faker::create();

        // Admin kullanıcı oluştur
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'developer@gmail.com',
            'password' => bcrypt('123456789'),
        ]);

        // SMS ayarlarını oluştur
        DB::table('sms_send_settings')->insert([
            'username' => 'username',
            'password' => 'password',
            'title' => 'title',
            'originator' => 'originator',
            'quota' => 0,
        ]);

        // Kampanyalar oluştur
        for ($i = 0; $i < 5; $i++) {
            DB::table('campaigns')->insert([
                'campaign_name' => $faker->sentence,
                'campaign_type' => $faker->randomElement(['SMS', 'E-posta']),
                'campaign_details' => $faker->sentence,
                'send_type' => $faker->randomElement(['Tekil', 'Toplu']),
                'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            ]);
        }

        // Müşterileri oluştur
        foreach (range(1, 20) as $index) {
            DB::table('customers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => '0' . $faker->numberBetween(5000000000, 5999999999),
                'password' => bcrypt('123456789'),
                'date_of_birth' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                'address_line1' => $faker->streetAddress,
                'address_line2' => $faker->secondaryAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'postal_code' => $faker->postcode,
                'gender' => $faker->randomElement(['erkek', 'kadin', 'diger']),
                'country' => $faker->country,
                'is_vip' => $faker->boolean(20),
                'total_visits' => $faker->numberBetween(1, 100),
                'total_spent' => $faker->randomFloat(2, 100, 10000),
                'last_visit' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'preferred_services' => $faker->words(3, true),
                'notes' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Hizmet ve oda isimleri
        $services = ['Botox', 'Dolgu', 'Lazer Epilasyon', 'Cilt Bakımı', 'Saç Bakımı', 'Masaj', 'Manikür', 'Pedikür', 'Ağda', 'Lazer Tedavisi'];
        $tables = ['Lazer Odası 1', 'Lazer Odası 2', 'Epilasyon Odası', 'Masaj Odası', 'Dolgu Odası', 'Botox Odası', 'Cilt Bakım Odası', 'Manikür Odası', 'Pedikür Odası', 'Ağda Odası'];

        // Odaları oluştur
        foreach ($tables as $tableName) {
            DB::table('tables')->insert([
                'name' => $tableName,
                'capacity' => rand(2, 10),
                'employee_id' => null, // Başlangıçta null, daha sonra atanacak
            ]);
        }

        // Çalışanları oluştur
        for ($i = 0; $i < 10; $i++) {
            $employeeId = DB::table('employees')->insertGetId([
                'name' => $faker->name,
                'salary' => $faker->randomFloat(2, 3000, 10000),
                'leave_days' => $faker->numberBetween(0, 20),
                'annual_leave_days' => 20,
                'position' => $faker->randomElement(['Doktor', 'Estetisyen']),
                'phone' => $faker->phoneNumber,
                'hire_date' => $faker->date(),
                'email' => $faker->unique()->safeEmail,
                'skills' => $faker->sentence,
                'is_active' => $faker->boolean,
            ]);

            // Odaya çalışan atayın
            $tableId = DB::table('tables')->inRandomOrder()->first()->id;
            DB::table('tables')->where('id', $tableId)->update(['employee_id' => $employeeId]);
        }

        // Hizmetleri ekleyin ve kategoriler oluşturun
        foreach ($services as $service) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $service,
                'description' => $faker->sentence,
                'is_active' => $faker->boolean,
                'image' => $faker->imageUrl(),
            ]);

            // Hizmetleri oluştur
            for ($i = 1; $i <= 2; $i++) { 
                $employeeId = DB::table('employees')->inRandomOrder()->first()->id;
                $tableId = DB::table('tables')->inRandomOrder()->first()->id;

                DB::table('services')->insert([
                    'name' => $service,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 50, 500),
                    'duration' => $faker->numberBetween(15, 120),
                    'image' => $faker->imageUrl(),
                    'employee_id' => $employeeId,
                    'is_active' => $faker->boolean,
                    'discount_price' => $faker->randomFloat(2, 50, 500),
                    'category_id' => $categoryId,
                ]);
            }
        }
    }
}
