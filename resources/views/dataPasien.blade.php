@extends('layouts.navbar')

@section('halamanuser')

    <div class="w-100 d-flex justify-content-center" style="margin-top: 60px">
        <div class="text-dark fw-bold mt-3 py-3 d-flex justify-content-center">
            <form action="{{ route('cari.pasien') }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                <label for="nomor_rm" class="me-2">Nomor RM:</label>
                <input type="text" name="nomor_rm" value="{{ old('nomor_rm') }}" required class="form-control w-auto border-3 border-satu">
                <button type="submit" class="btn btn-tiga fw-bold">Cari</button>
            </form>
            <form action="{{ route('reset.antrian') }}" method="POST" class="ms-2">
                @csrf
                <button type="submit" class="btn btn-danger fw-bold">Reset Antrian</button>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center text-white">
        <div class="w-100 px-3">
            <div class="pb-5">
                <h3 class="text-center m-0 py-2 bg-dua text-white sticky-top rounded-3" style="top: 0; z-index: 3;">
                    Antrian Resep Apotek
                </h3>
                <div class="mt-2 table-responsive bg-tiga rounded-3 custom-shadow scroll-tabel">
                    <table cellpadding="10" cellspacing="1" class="w-100 text-center">
                        <thead class="bg-satu sticky-top" style="top: 0; z-index: 2;">
                            <tr>
                                <th>No</th>
                                <th>Nomor RM</th>
                                <th>Waktu</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Asal Pasien</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-medium text-dark">
                            @php
                                use App\Models\AntrianPasien;

                                $antrian = AntrianPasien::whereDate('waktu_antrian', now()->toDateString())
                                    ->where('status', '!=', 'Selesai')
                                    ->get();
                            @endphp
                            @if ($antrian->isNotEmpty())
                                @foreach ($antrian as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->nomor_rm }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->waktu_antrian)->format('d-m-Y H:i') }}</td>
                                    <td class="bt-text">{{ $data->nama_pasien }}</td>
                                    <td class="bt-text">{{ $data->nama_dokter }}</td>
                                    <td>{{ $data->asal_pasien }}</td>
                                    <td>
                                        <span class="fw-medium text-dark
                                            {{ $data->status === 'Dipanggil' ? 'bg-dua text-white p-1 rounded-3' : '' }}">
                                            {{ $data->status ?? 'Menunggu' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('panggil.pasien', $data->nomor_rm) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-satu btn-sm fw-bold text-white"
                                                onclick="panggilPasien('{{ $data->nama_pasien }}', '{{ $data->nomor_rm }}')"
                                                {{ $data->status === 'Selesai' ? 'disabled' : '' }}>
                                                Panggil
                                            </button>
                                            <script>
                                                function panggilPasien(nama, nomor_rm) {
                                                    axios.post('/update-data', {
                                                        id: nomor_rm,
                                                        nama: nama,
                                                        status: 'Dipanggil'
                                                    })
                                                    .then(response => {
                                                        console.log(response.data.message); // Pesan dari backend
                                                    })
                                                    .catch(error => {
                                                        console.log(error);
                                                    });
                                                }

                                                function selesaiPasien(nomor_rm) {
                                                    axios.post('/update-data', {
                                                        id: nomor_rm,
                                                        status: 'Selesai'
                                                    })
                                                    .then(response => {
                                                        console.log(response.data.message);
                                                    })
                                                    .catch(error => {
                                                        console.log(error);
                                                    });
                                                }
                                            </script>
                                        </form>
                                        <form action="{{ route('selesai.pasien', $data->nomor_rm) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-dua btn-sm fw-bold border-2 border-satu"
                                                {{ $data->status !== 'Dipanggil' ? 'disabled' : '' }}>
                                                Selesai
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8">Tidak ada pasien dalam antrian.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pb-3">
                <h3 class="text-center m-0 py-2 bg-empat text-white sticky-top rounded-3" style="top: 0; z-index: 3;">
                    Pasien Selesai
                </h3>
                <div class="mt-2 mx-auto table-responsive bg-tiga rounded-3 custom-shadow scroll-tabel">
                    <table cellpadding="10" cellspacing="1" class="w-100 text-center">
                        <thead class="bg-lima sticky-top text-white">
                            <tr>
                                <th>No</th>
                                <th>Nomor RM</th>
                                <th>Waktu</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Asal Pasien</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="fw-medium text-dark">
                            @php
                                $antrian_selesai = AntrianPasien::whereDate('waktu_antrian', now()->toDateString())
                                    ->where('status', 'Selesai')
                                    ->get();
                            @endphp
                            @if ($antrian_selesai->isNotEmpty())
                                @foreach ($antrian_selesai as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->nomor_rm }}</td>
                                    <td>{{ $data->waktu_antrian }}</td>
                                    <td class="bt-text">{{ $data->nama_pasien }}</td>
                                    <td class="bt-text">{{ $data->nama_dokter }}</td>
                                    <td class="bt-text">{{ $data->asal_pasien }}</td>
                                    <td>
                                        <span class="fw-medium p-1 bg-empat rounded-3 text-white">
                                            {{ $data->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Belum ada pasien yang selesai.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/pemanggilan.js') }}"></script>

@endsection
