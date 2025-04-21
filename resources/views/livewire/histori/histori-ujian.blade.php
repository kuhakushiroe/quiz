<div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Soal</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th>Jawaban</th>
            <th>Jawaban Benar</th>
        </tr>
        @forelse ($hasilujian as $data)
            <tr>
                <td>{{ $data->soal }}</td>
                <td>{{ $data->jawabanA }}</td>
                <td>{{ $data->jawabanB }}</td>
                <td>{{ $data->jawabanC }}</td>
                <td>{{ $data->jawabanD }}</td>
                <td>{{ $data->jawaban }}</td>
                <td>{{ $data->jawabanBenar }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Data tidak ditemukan</td>
            </tr>
        @endforelse
        @php
            $jumlahBenar = $hasilujian
                ->filter(function ($item) {
                    return $item->jawaban === $item->jawabanBenar;
                })
                ->count();
        @endphp
        <tr>
            <td colspan="7" class="text-center">JUMLAH BENAR : {{ $jumlahBenar }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-center">NILAI : {{ $jumlahBenar * 4 }}</td>
        </tr>
    </table>
    {{-- Success is as dangerous as failure. --}}
</div>
