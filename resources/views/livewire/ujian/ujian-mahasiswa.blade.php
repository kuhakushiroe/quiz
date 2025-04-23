<div>
    @if ($form)
        <div class="card text-start">
            <div class="card-header">
                <h3 class="card-title">Mulai Ujian</h3>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group mb-2">
                        <label for="codecek">Code {{ $name }}</label>
                        <input type="text" class="form-control @error('codecek') is-invalid @enderror"
                            wire:model="codecek" placeholder="Code Untuk Mulai Ujian / Password">
                        @error('codecek')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-secondary btn-sm"
                            wire:click.prevent="start('{{ $id_openclass }}')">Join</button>
                        <button class="btn btn-outline-danger btn-sm" wire:click="closeForm">Close</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        {{-- Jika Memiliki Soal --}}
        @forelse ($soal as $index => $datasoal)
            <div class="card mb-3">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        {{ $index + 1 }}.{{ $datasoal->soal }}
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th style="width: 10px">
                                    A.
                                    <input class="form-check-input" type="radio" value="A"
                                        wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                        wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                    {{ $datasoal->jawabanA }}
                                </th>
                                <th style="width: 10px">
                                    B.
                                    <input class="form-check-input" type="radio" value="B"
                                        wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                        wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                    {{ $datasoal->jawabanB }}
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 10px">
                                    C.
                                    <input class="form-check-input" type="radio" value="C"
                                        wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                        wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                    {{ $datasoal->jawabanC }}
                                </th>
                                <th style="width: 10px">D.
                                    <input class="form-check-input" type="radio" value="D"
                                        wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                        wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                    {{ $datasoal->jawabanD }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        @empty
            {{-- jika tidak ada soal --}}
            <div class="card text-start">
                <div class="card-header">
                    <h3 class="card-title">Menu Soal</h3>
                </div>
                <div class="card-body">
                    @forelse ($kelas as $data)
                        <button class="btn btn-outline-primary btn-lg" wire:click="open({{ $data->id }})">
                            {{ $data->name }}
                        </button>
                    @empty
                    @endforelse
                </div>
            </div>
        @endforelse
    @endif
</div>
