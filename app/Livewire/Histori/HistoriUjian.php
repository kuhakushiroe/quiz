<?php

namespace App\Livewire\Histori;

use App\Models\Mahasiswa;
use App\Models\Ujian;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class HistoriUjian extends Component
{
    #[Title('Hasil Ujian')]
    public function render()
    {
        if (auth()->user()->role == 'dosen') {
            $hasilujian = Ujian::join('openclass', 'ujian.id_openclass', '=', 'openclass.id')
                ->join('banksoal', 'ujian.id_banksoal', '=', 'banksoal.id')
                ->join('mahasiswa', 'ujian.id_mahasiswa', '=', 'mahasiswa.id')
                ->select('openclass.*', 'banksoal.*', 'ujian.*', 'mahasiswa.*', 'ujian.id as id_ujian')
                ->where('id_dosen', auth()->user()->id)
                ->where('openclass.end', '<', now())
                ->orderBy('openclass.end', 'desc')
                ->get();
        } else {
            $cariidmahasiswa = Mahasiswa::where('nim', auth()->user()->username)->first();
            $hasilujian = Ujian::join('openclass', 'ujian.id_openclass', '=', 'openclass.id')
                ->join('banksoal', 'ujian.id_banksoal', '=', 'banksoal.id')
                ->select('openclass.*', 'banksoal.*', 'ujian.*', 'ujian.id as id_ujian')
                ->where('id_mahasiswa', $cariidmahasiswa->id)
                ->where('openclass.end', '<', now())
                ->orderBy('openclass.end', 'desc')
                ->get();
        }
        return view('livewire.histori.histori-ujian', [
            'hasilujian' => $hasilujian
        ]);
    }
}
