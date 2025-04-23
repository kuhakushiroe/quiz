<?php

namespace App\Livewire\Ujian;

use App\Models\Banksoal;
use App\Models\OpenClass;
use App\Models\Ujian;
use Livewire\Attributes\Title;
use Livewire\Component;

class UjianMahasiswa extends Component
{
    #[Title('Ujian Mahasiswa')]
    public $form = false;
    public $id_openclass, $jumlah_soal, $name, $id_dosen, $code, $codecek;
    public $jawaban = [];
    public function open($id)
    {
        $data = OpenClass::find($id);
        $this->id_openclass = $data->id;
        $this->id_dosen = $data->id_dosen;
        $this->name = $data->name;
        $this->code = $data->code;
        $this->jumlah_soal = $data->jumlah_soal;
        $this->form = true;
    }
    public function close()
    {
        $this->id_openclass = null;
        $this->codecek = null;
        $this->code = null;
        $this->name = null;
        $this->id_dosen = null;
        $this->jumlah_soal = null;
        $this->form = false;
    }
    public function start($id)
    {
        $this->validate([
            'id_openclass' => 'required',
            'codecek' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== $this->code) {
                        $fail('Kode yang dimasukkan tidak cocok.');
                    }
                },
            ],
        ]);
        $soal = Banksoal::where('id_users', $this->id_dosen)
            ->inRandomOrder()
            ->take($this->jumlah_soal)
            ->get();
        foreach ($soal as $s) {
            Ujian::create([
                'id_mahasiswa' => auth()->user()->id,
                'id_openclass' => $this->id_openclass,
                'id_banksoal' => $s->id,
                'jawaban' => "E",
            ]);
        }
        $this->form = false;
    }
    public function simpanJawaban($id)
    {
        $pilihan = $this->jawaban[$id] ?? null;

        if ($pilihan) {
            Ujian::updateOrCreate(
                [
                    'id' => $id,
                ],
                [
                    'jawaban' => $pilihan,
                ]
            );
        }
    }
    public function mount()
    {
        $jawabanTersimpan = Ujian::join('openclass', 'ujian.id_openclass', '=', 'openclass.id')
            ->join('banksoal', 'ujian.id_banksoal', '=', 'banksoal.id')
            ->select('openclass.*', 'banksoal.*', 'ujian.*', 'ujian.id as id_ujian')
            ->where('id_mahasiswa', auth()->user()->id)
            ->where('openclass.end', '>', now())
            ->get();

        foreach ($jawabanTersimpan as $jawab) {
            $this->jawaban[$jawab->id_ujian] = $jawab->jawaban;
        }
    }
    public function render()
    {
        $kelas = OpenClass::where('start', '<=', now())
            ->where('end', '>=', now())
            ->get();
        $soal = Ujian::join('openclass', 'ujian.id_openclass', '=', 'openclass.id')
            ->join('banksoal', 'ujian.id_banksoal', '=', 'banksoal.id')
            ->select('openclass.*', 'banksoal.*', 'ujian.*', 'ujian.id as id_ujian')
            ->where('id_mahasiswa', auth()->user()->id)
            ->where('openclass.end', '>', now())
            ->get();
        return view('livewire.ujian.ujian-mahasiswa', [
            'kelas' => $kelas,
            'soal' => $soal
        ]);
    }
}
