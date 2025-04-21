<?php

namespace App\Livewire\Users;

use App\Models\Mahasiswa;
use App\Models\User as ModelsUser;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    #[Title('Users')]
    public function delete($id)
    {
        $user = ModelsUser::find($id);
        $mahasiswa = Mahasiswa::where('nim', $user->username)->first();
        if ($user->role === 'superadmin') {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal',
                text: 'Superadmin Tidak Boleh Dihapus',
                position: 'center',
                confirm: true,
                redirect: '/users',
            );
        } else {
            $user->delete();
            $mahasiswa->delete();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Berhasil',
                text: 'Berhasil Menghapus Data',
                position: 'center',
                confirm: true,
                redirect: '/users',
            );
        }
        return;
    }
    public function restore(int $id)
    {
        // Mencari data yang sudah di-soft delete dengan menggunakan withTrashed()
        $user = ModelsUser::withTrashed()->find($id);

        if ($user) {
            // Mengembalikan data yang telah di-soft delete
            $user->restore();
            $mahasiswa = Mahasiswa::withTrashed()->where('nim', $user->username)->first();
            $mahasiswa->restore();

            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Berhasil',
                text: 'Berhasil Restore Data',
                position: 'center',
                confirm: true,
                redirect: '/users',
            );
        } else {
            // Menangani jika data tidak ditemukan
        }
        return;
    }
    public function render()
    {
        $users = ModelsUser::whereAny(['username', 'email', 'name'], 'like', '%' . $this->search . '%')
            ->withTrashed()
            ->paginate(5);
        return view('livewire.users.user', [
            'users' => $users,
        ]);
    }
}
