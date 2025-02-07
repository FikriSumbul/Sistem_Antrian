@extends('layouts.navbar')

@section('halamanuser')

    <div class="w-100 d-flex justify-content-center">
        <div class="text-white py-3 d-flex justify-content-center">
            <form action="{{ route('cari.pasien') }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                <label for="nomor_rm" class="me-2">Nomor RM:</label>
                <input type="text" name="nomor_rm" value="{{ old('nomor_rm') }}" required class="form-control w-auto">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <form action="{{ route('reset.antrian') }}" method="POST" class="ms-2">
                @csrf
                <button type="submit" class="btn btn-danger">Reset Antrian</button>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center text-white">
        <table cellpadding="10" cellspacing="1" style="width: 80%; margin: auto; text-align: center;">
            <tr class="bg-navbar">
                <td>No</td>
                <td>Nomor RM</td>
                <td>Nama Pasien</td>
                <td>Dokter</td>
                <td>Asal Pasien</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
            @if (session()->has('antrian'))
                @foreach (session('antrian') as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="bt-text">{{ $data['nomor_rm'] }}</td>
                    <td class="bt-text">{{ $data['nama_pasien'] }}</td>
                    <td class="bt-text">{{ $data['nama_dokter'] }}</td>
                    <td class="bt-text">{{ $data['asal_pasien'] }}</td>
                    <td>
                        <span class="badge {{ ($data['status'] ?? '') === 'Selesai' ? 'bg-success text-white' : '' }}">
                            {{ $data['status'] ?? 'Menunggu' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('panggil.pasien', $data['nomor_rm']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm"
                                {{ ($data['status'] ?? '') === 'Selesai' ? 'disabled' : '' }}>Panggil</button>
                        </form>
                        <form action="{{ route('selesai.pasien', $data['nomor_rm']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm"
                                {{ (($data['status'] ?? '') !== 'Dipanggil') ? 'disabled' : '' }}>Selesai</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>

@endsection
