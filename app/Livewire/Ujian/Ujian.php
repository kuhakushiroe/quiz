<?php

namespace App\Livewire\Ujian;

use App\Models\OpenClass;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Ujian extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Title('Test')]
    public $form = false;
    public $search = '';
    public $nama, $id_dosen, $code, $jumlah_soal, $startdate, $enddate;
    public function openForm()
    {
        $this->form = true;
    }
    public function closeForm()
    {
        $this->form = false;
        $this->reset();
    }
    public function store()
    {
        if (in_array(auth()->user()->role, ['superadmin', 'admin'])) {
            $this->validate([
                'id_dosen' => 'required',
                'code' => 'required',
                'nama' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'jumlah_soal' => 'required|numeric',
            ], [
                'id_dosen.required' => 'Dosen Harus Diisi',
                'code.required' => 'Code Harus Diisi',
                'nama.required' => 'Nama Harus Diisi',
                'startdate.required' => 'Start Date Harus Diisi',
                'enddate.required' => 'End Date Harus Diisi',
                'jumlah_soal.required' => 'Jumlah Soal Harus Diisi',
                'jumlah_soal.numeric' => 'Jumlah Soal Harus Berupa Angka',
            ]);
            $datadosen = $this->id_dosen;
        } else {
            $this->validate([
                'code' => 'required',
                'nama' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'jumlah_soal' => 'required|numeric',
            ], [
                'code.required' => 'Code Harus Diisi',
                'nama.required' => 'Nama Harus Diisi',
                'startdate.required' => 'Start Date Harus Diisi',
                'enddate.required' => 'End Date Harus Diisi',
                'jumlah_soal.required' => 'Jumlah Soal Harus Diisi',
                'jumlah_soal.numeric' => 'Jumlah Soal Harus Berupa Angka',
            ]);
            $datadosen = auth()->user()->id;
        }

        OpenClass::create([
            'id_dosen' => $datadosen,
            'code' => $this->code,
            'name' => $this->nama,
            'start' => $this->startdate,
            'end' => $this->enddate,
            'jumlah_soal' => $this->jumlah_soal
        ]);
        $this->closeForm();
    }
    public function delete($id)
    {
        $data = OpenClass::find($id);
        $data->delete();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Berhasil',
            text: 'Berhasil Menghapus Data',
            position: 'center',
            confirm: true,
            redirect: '/ujian-dosen',
        );
        return;
    }
    public function restore(int $id)
    {
        // Mencari data yang sudah di-soft delete dengan menggunakan withTrashed()
        $data = OpenClass::withTrashed()->find($id);
        if ($data) {
            // Mengembalikan data yang telah di-soft delete
            $data->restore();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Berhasil',
                text: 'Berhasil Restore Data',
                position: 'center',
                confirm: true,
                redirect: '/ujian-dosen',
            );
        } else {
            // Menangani jika data tidak ditemukan
        }
        return;
    }
    public function render()
    {
        $dosen = User::where('role', 'dosen')->get();
        $kelas = OpenClass::whereAny(['code', 'name'], 'like', '%' . $this->search . '%')
            ->withTrashed()
            ->paginate(10);
        return view(
            'livewire.ujian.ujian',
            [
                'kelas' => $kelas,
                'caridosen' => $dosen
            ]
        );
    }
}
