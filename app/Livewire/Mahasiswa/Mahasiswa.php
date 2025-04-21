<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Mahasiswa as ModelsMahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Mahasiswa extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    #[Title('Mahasiswa')]
    public function delete($id)
    {
        $data = ModelsMahasiswa::find($id);
        $user = User::where('username', $data->nim)->first();
        $data->delete();
        $user->delete();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Berhasil',
            text: 'Berhasil Menghapus Data',
            position: 'center',
            confirm: true,
            redirect: '/mahasiswa',
        );
        return;
    }
    public function restore(int $id)
    {
        // Mencari data yang sudah di-soft delete dengan menggunakan withTrashed()
        $data = ModelsMahasiswa::withTrashed()->find($id);
        if ($data) {
            // Mengembalikan data yang telah di-soft delete
            $data->restore();
            $user = User::withTrashed()->where('username', $data->nim)->first();
            $user->restore();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Berhasil',
                text: 'Berhasil Restore Data',
                position: 'center',
                confirm: true,
                redirect: '/mahasiswa',
            );
        } else {
            // Menangani jika data tidak ditemukan
        }
        return;
    }
    public function render()
    {
        $mahasiswa = ModelsMahasiswa::whereAny(['nim', 'nama'], 'like', '%' . $this->search . '%')
            ->withTrashed()
            ->paginate(10);
        return view('livewire.mahasiswa.mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
}
