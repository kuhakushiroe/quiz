<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <form wire:submit.prevent="bacaOcr">
        <div class="card-body">
            <div class="form-group">
                <label for="fileKtp">Foto KTP</label>
                <input type="file" class="form-control form-control-sm @error('fileKtp') is-invalid @enderror"
                    wire:model="fileKtp" placeholder="Foto KTP">
                @error('fileKtp')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @if ($text)
        <h3>Hasil OCR:</h3>
        <p>{{ $text }}</p>
    @endif
</div>
