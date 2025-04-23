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
        @if ($soal->isNotEmpty())
            <div class="alert alert-info text-center">
                Sisa Waktu: <span id="timer" class="fw-bold"></span>
            </div>

            <script>
                const endTime = new Date("{{ \Carbon\Carbon::parse($soal->first()->end)->format('Y-m-d H:i:s') }}").getTime();

                const timerInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance <= 0) {
                        clearInterval(timerInterval);
                        document.getElementById("timer").innerHTML = "Waktu Habis";

                        // ✅ Reload otomatis saat waktu habis
                        location.reload();
                        return;
                    }

                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("timer").innerHTML = `${minutes} menit ${seconds} detik`;
                }, 1000);
            </script>
        @endif

        @forelse ($soal as $index => $datasoal)
            <div class="card mb-3">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        {{ $index + 1 }}.{{ $datasoal->soal }}
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="radio" value="A"
                                            wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                            wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                        <span><strong>A.</strong> {{ $datasoal->jawabanA }}</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="radio" value="B"
                                            wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                            wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                        <span><strong>B.</strong> {{ $datasoal->jawabanB }}</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="radio" value="C"
                                            wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                            wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                        <span><strong>C.</strong> {{ $datasoal->jawabanC }}</span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="radio" value="D"
                                            wire:model="jawaban.{{ $datasoal->id_ujian }}"
                                            wire:change="simpanJawaban({{ $datasoal->id_ujian }})">
                                        <span><strong>D.</strong> {{ $datasoal->jawabanD }}</span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
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
                        <h5 class="text-center">Belum Ada Soal</h5>
                    @endforelse
                </div>
            </div>
        @endforelse
    @endif
</div>
