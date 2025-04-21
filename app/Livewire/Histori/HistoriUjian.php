<?php

namespace App\Livewire\Histori;

use App\Models\Ujian;
use Livewire\Attributes\Title;
use Livewire\Component;

class HistoriUjian extends Component
{
    #[Title('Hasil Ujian')]
    public function render()
    {
        $hasilujian = Ujian::join('openclass', 'ujian.id_openclass', '=', 'openclass.id')
            ->join('banksoal', 'ujian.id_banksoal', '=', 'banksoal.id')
            ->select('openclass.*', 'banksoal.*', 'ujian.*', 'ujian.id as id_ujian')
            ->where('id_mahasiswa', auth()->user()->id)
            ->where('openclass.end', '<', now())
            ->get();
        return view('livewire.histori.histori-ujian', [
            'hasilujian' => $hasilujian
        ]);
    }
}
