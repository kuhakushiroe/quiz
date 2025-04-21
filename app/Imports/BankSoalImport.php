<?php

namespace App\Imports;

use App\Models\Banksoal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankSoalImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    protected $id_users;
    protected $isSuperadmin;

    public function __construct($id_users, $isSuperadmin = false)
    {
        $this->id_users = $id_users;
        $this->isSuperadmin = $isSuperadmin;
    }

    public function model(array $row)
    {
        $id_users = $this->isSuperadmin
            ? $row['dosen'] // ambil dari kolom excel kalau superadmin
            : $this->id_users; // ambil dari auth()->id() kalau dosen biasa

        return new Banksoal([
            'soal'         => $row['soal'],
            'jawabanA'     => $row['a'],
            'jawabanB'     => $row['b'],
            'jawabanC'     => $row['c'],
            'jawabanD'     => $row['d'],
            'jawabanBenar' => $row['jawaban'],
            'id_users'     => $id_users,
        ]);
    }
}
