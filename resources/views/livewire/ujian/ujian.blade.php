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
        @if ($form)
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Ujian</label>
                        <input type="text"
                            class="form-control
                        @error('nama') is-invalid @enderror"
                            wire:model="nama" placeholder="Nama Ujian">
                        @error('nama')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    @if (in_array(auth()->user()->role, ['admin', 'superadmin']))
                        <div class="form-group">
                            <label for="id_dosen">Dosen</label>
                            <select name="id_dosen" wire:model="id_dosen"
                                class="form-control @error('id_dosen') is-invalid @enderror">
                                <option value="">Pilih Dosen</option>
                                @foreach ($caridosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('id_dosen')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="jumlah_soal">Jumlah Soal</label>
                        <input type="text" class="form-control @error('jumlah_soal') is-invalid @enderror"
                            wire:model="jumlah_soal" placeholder="Jumlah Soal">
                        @error('jumlah_soal')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" wire:model="code"
                            placeholder="Code Untuk Mulai Ujian / Password">
                        @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Start</label>
                        <div class="input-group mb-3">
                            <input type="datetime-local" class="form-control @error('startdate') is-invalid @enderror"
                                wire:model="startdate">
                            @error('startdate')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">End</label>
                        <div class="input-group mb-3">
                            <input type="datetime-local" class="form-control @error('enddate') is-invalid @enderror "
                                wire:model="enddate">
                            @error('enddate')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-secondary btn-sm" wire:click.prevent="store">Simpan</button>
                        <button class="btn btn-outline-danger btn-sm" wire:click="closeForm">Close</button>
                    </div>
                </form>
            </div>
        @else
            <div class="card-body table-responsive">
                <div class="mb-2">
                    <button class="btn btn-outline-secondary btn-sm" wire:click="openForm"><span
                            class="bi bi-plus"></span></button>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ujian</th>
                            <th>Code</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $data)
                            <tr>
                                <td>
                                    Edit|
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
                                            {{ $data->name }}
                                            {{ $data->deleted_at ? ' Deleted ' : '' }}
                                        </i>
                                    @else
                                        {{ $data->name }}
                                    @endif
                                </td>
                                <td>{{ $data->code }}</td>
                                <td>{{ $data->start }}</td>
                                <td>{{ $data->end }}</td>
                                <td
                                    @if ($data->end < now()) style="background-color: red" @else style="background-color: green" @endif>
                                    @if ($data->end < now())
                                        Close
                                    @else
                                        Open
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pt-2">
                    {{ $kelas->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
