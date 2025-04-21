<div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Data Soal</h3>
            <div class="card-tools m-0">
                <div class="input-group input-group-sm">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Cari">
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <div class="mb-2 col-md-3">
                <form wire:submit.prevent="import">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                            wire:model="file">
                        <button class="btn btn-outline-secondary" type="submit">Import</button>

                        @error('file')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Dosen</th>
                        <th>Soal</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>Kunci</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($soal as $data)
                        <tr>
                            <td>
                                @if ($data->deleted_at)
                                    <button class="btn btn-outline-success btn-sm"
                                        wire:click="restore({{ $data->id }})">
                                        <span class="bi bi-repeat"></span>
                                    </button>
                                @else
                                    <button class="btn btn-outline-danger btn-sm"
                                        wire:click="delete({{ $data->id }})">
                                        <span class="bi bi-trash"></span>
                                    </button>
                                @endif
                            </td>
                            <td>{{ $data->dosen->name }}</td>
                            <td>
                                @if ($data->deleted_at)
                                    <i class="text-decoration-line-through">
                                        {{ $data->soal }}
                                        {{ $data->deleted_at ? ' Deleted ' : '' }}
                                    </i>
                                @else
                                    {{ $data->soal }}
                                @endif
                            </td>
                            <td>{{ $data->jawabanA }}</td>
                            <td>{{ $data->jawabanB }}</td>
                            <td>{{ $data->jawabanC }}</td>
                            <td>{{ $data->jawabanD }}</td>
                            <td>{{ $data->jawabanBenar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pt-2">
                {{ $soal->links() }}
            </div>
        </div>
    </div>
</div>
