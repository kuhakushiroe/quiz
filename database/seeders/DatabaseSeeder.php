<?php

namespace Database\Seeders;

use App\Models\Banksoal;
use App\Models\Mahasiswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $faker = Faker::create();
        User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'role' => 'superadmin',
            'password' => Hash::make('426615790'),
        ]);
        User::create([
            'name' => 'Rima Buana Prahastiwi',
            'username' => 'buanarima',
            'email' => 'buanarima@gmail.com',
            'role' => 'dosen',
            'password' => Hash::make('426615790'),
        ]);
        $dosenIds = User::where('role', 'dosen')->pluck('id')->toArray();
        $idDosen = $faker->randomElement($dosenIds);
        foreach (range(1, 100) as $index) {
            $name = $faker->name;
            $number = $faker->unique()->numerify('###########');
            Mahasiswa::create([
                'nama' => $name,
                'nim' => $number,
            ]);
            User::create([
                'name' => $name,
                'username' => $number,
                'email' => $number . '@example.com',
                'role' => 'mahasiswa', // Assign subrole acak
                'password' => Hash::make('password'),
            ]);
            // Banksoal::create([
            //     'id_users' => $idDosen,
            //     'soal' => $faker->sentence,
            //     'jawabanA' => $faker->sentence,
            //     'jawabanB' => $faker->sentence,
            //     'jawabanC' => $faker->sentence,
            //     'jawabanD' => $faker->sentence,
            //     'jawabanBenar' => $faker->randomElement(['A', 'B', 'C', 'D']),
            // ]);
        }
    }
}
