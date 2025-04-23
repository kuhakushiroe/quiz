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
        // $idDosen = $faker->randomElement($dosenIds);
        $mahasiswaList = [
            ['nim' => '220108002', 'nama' => 'MUHAMMAD FAHRUL KHOLIDY'],
            ['nim' => '220108004', 'nama' => 'NADIA FEBRIANA'],
            ['nim' => '220108005', 'nama' => 'RIADATUN HASANAH'],
            ['nim' => '220108006', 'nama' => 'MUSNAINI'],
            ['nim' => '220108007', 'nama' => 'DELA YUNITA RIZKI'],
            ['nim' => '220108009', 'nama' => 'LAELATIN NINGSIH'],
            ['nim' => '220108012', 'nama' => 'LIA ISMI MAWANTI'],
            ['nim' => '220108014', 'nama' => 'M. ANNIEL SEPTIAN PRATAMA PUTRA N.'],
            ['nim' => '220108015', 'nama' => 'M. HANIF AL AFANI'],
            ['nim' => '220108018', 'nama' => 'SILVA DIADARA'],
            ['nim' => '220108019', 'nama' => 'NURUL TITIAN LESTARI'],
            ['nim' => '220108020', 'nama' => "MUHAMMAD KHAIRUL YUSNI SYA'BANI"],
            ['nim' => '220108021', 'nama' => 'SINDI YASARI'],
            ['nim' => '220108022', 'nama' => 'AULIA RAMDANI BAFADAL'],
            ['nim' => '220108023', 'nama' => 'FAIZIN'],
        ];

        foreach ($mahasiswaList as $data) {
            $mahasiswa = Mahasiswa::create([
                'nim' => $data['nim'],
                'nama' => $data['nama'],
            ]);

            User::create([
                'name' => $data['nama'],
                'username' => $data['nim'],
                'email' => $data['nim'] . '@example.com',
                'role' => 'mahasiswa',
                'password' => Hash::make($data['nim']), // Password disamakan dengan NIM
            ]);
        }
    }
}
