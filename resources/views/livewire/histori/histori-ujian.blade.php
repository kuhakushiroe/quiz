<div>
    @php
        $groupedUjian = $hasilujian->groupBy('id_openclass');
    @endphp

    @forelse ($groupedUjian as $idOpenclass => $dataUjianPerKelas)
        <div class="card my-4">
            <div class="card-header bg-primary text-white">
                <strong>Kelas: {{ $dataUjianPerKelas->first()->nama }}</strong> <br>
                <small>Selesai:
                    {{ \Carbon\Carbon::parse($dataUjianPerKelas->first()->end)->format('d M Y H:i') }}</small>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Soal</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>Jawaban</th>
                            <th>Jawaban Benar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $jumlahBenar = 0;
                        @endphp
                        @foreach ($dataUjianPerKelas as $data)
                            <tr>
                                <td>{{ $data->soal }}</td>
                                <td>{{ $data->jawabanA }}</td>
                                <td>{{ $data->jawabanB }}</td>
                                <td>{{ $data->jawabanC }}</td>
                                <td>{{ $data->jawabanD }}</td>
                                <td
                                    class="{{ $data->jawaban === $data->jawabanBenar ? 'text-success' : 'text-danger' }}">
                                    {{ $data->jawaban }}
                                </td>
                                <td>{{ $data->jawabanBenar }}</td>
                            </tr>
                            @if ($data->jawaban === $data->jawabanBenar)
                                @php $jumlahBenar++; @endphp
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="7" class="text-center"><strong>JUMLAH BENAR: {{ $jumlahBenar }} dari
                                    {{ $dataUjianPerKelas->first()->jumlah_soal }} soal</strong></td>
                        </tr>
                        <tr>
                            @php
                                $jumlahSoal = $dataUjianPerKelas->first()->jumlah_soal;
                                $nilai = $jumlahSoal > 0 ? number_format(($jumlahBenar / $jumlahSoal) * 100, 2) : 0;
                            @endphp
                            <td colspan="7" class="text-center"><strong>NILAI: {{ $nilai }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">Belum ada hasil ujian tersedia.</div>
    @endforelse
</div>
