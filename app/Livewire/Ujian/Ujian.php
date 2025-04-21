<?php

namespace App\Livewire\Ujian;

use App\Models\OpenClass;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Ujian extends Component
{
    use WithPagination, WithoutUrlPagination;
    #[Title('Test')]
    public $form = false;
    public $search = '';
    public $nama, $code, $startdate, $starttime, $enddate, $endtime;
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
        $this->validate([
            'code' => 'required',
            'nama' => 'required',
            'startdate' => 'required',
            'starttime' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
        ], [
            'code.required' => 'Code Harus Diisi',
            'nama.required' => 'Nama Harus Diisi',
            'startdate.required' => 'Start Date Harus Diisi',
            'starttime.required' => 'Start Time Harus Diisi',
            'enddate.required' => 'End Date Harus Diisi',
            'endtime.required' => 'End Time Harus Diisi',
        ]);
        OpenClass::create([
            'id_dosen' => auth()->user()->id,
            'code' => $this->code,
            'name' => $this->nama,
            'start' => $this->startdate . ' ' . $this->starttime,
            'end' => $this->enddate . ' ' . $this->endtime,
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
        $kelas = OpenClass::whereAny(['code', 'name'], 'like', '%' . $this->search . '%')
            ->withTrashed()
            ->paginate(10);
        return view(
            'livewire.ujian.ujian',
            [
                'kelas' => $kelas
            ]
        );
    }
}
