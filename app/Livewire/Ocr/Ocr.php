<?php

namespace App\Livewire\Ocr;

use Alimranahmed\LaraOCR\Facades\OCR as FacadesOCR;
use Illuminate\Container\Attributes\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ocr extends Component
{
    use WithFileUploads;

    public $fileKtp;
    public $text = '';

    public function bacaOcr()
    {
        $this->validate([
            'fileKtp' => 'required',
        ]);

        // Simpan file ke storage public
        //$filePath = $this->fileKtp->store('ocr_uploads', 'public');

        // Dapatkan path absolut
        // $absolutePath = storage_path("app/public/{$filePath}");
        $absolutePath = storage_path("app/public/ocr_uploads/1.jpg");

        // Lakukan pemindaian OCR
        $this->text = FacadesOCR::scan($absolutePath);

        // Hapus file setelah diproses
        //unlink($absolutePath);
    }

    public function render()
    {
        return view('livewire.ocr.ocr');
    }
}
