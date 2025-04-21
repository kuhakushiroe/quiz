<?php

namespace App\Livewire\Banksoal;

use App\Imports\BankSoalImport;
use App\Models\Banksoal as ModelsBanksoal;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Banksoal extends Component
{
    use WithFileUploads;
    use WithPagination, WithoutUrlPagination;
    public $search = '';
    public $form = false;
    public $file;
    #[Title('Bank Soal')]

    public function openForm()
    {
        $this->form = true;
    }
    public function closeForm()
    {
        $this->form = false;
        $this->reset();
    }
    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $user = auth()->user();
        $isSuperadmin = $user->role === 'superadmin';

        Excel::import(
            new BanksoalImport($user->id, $isSuperadmin),
            $this->file->getRealPath()
        );

        session()->flash('success', 'Soal berhasil diimport!');
        $this->reset('file');
    }
    public function delete($id)
    {
        $data = ModelsBanksoal::find($id);
        $data->delete();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Berhasil',
            text: 'Berhasil Menghapus Data',
            position: 'center',
            confirm: true,
            redirect: '/bank-soal',
        );
        return;
    }
    public function restore(int $id)
    {
        // Mencari data yang sudah di-soft delete dengan menggunakan withTrashed()
        $data = ModelsBanksoal::withTrashed()->find($id);
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
                redirect: '/bank-soal',
            );
        } else {
            // Menangani jika data tidak ditemukan
        }
        return;
    }
    public function render()
    {
        $soals = ModelsBanksoal::whereAny(['soal'], 'like', '%' . $this->search . '%')
            ->withTrashed()
            ->paginate(10);
        return view('livewire.banksoal.banksoal', [
            'soal' => $soals
        ]);
    }
}
