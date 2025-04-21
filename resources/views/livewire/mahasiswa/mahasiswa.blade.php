<div>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Data Mahasiswa</h3>
            <div class="card-tools m-0">
                <div class="input-group input-group-sm">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Cari">
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nim</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $data)
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
                            <td>
                                @if ($data->deleted_at)
                                    <i class="text-decoration-line-through">
                                        {{ $data->nim }}
                                        {{ $data->deleted_at ? ' Deleted ' : '' }}
                                    </i>
                                @else
                                    {{ $data->nim }}
                                @endif
                            </td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pt-2">
                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>
</div>
