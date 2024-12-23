@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Riwayat Monitoring</h6>
            </div>

            <!-- Form Filter Data -->
            <form action="/dashboard/histories" method="get">
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="filter" value="{{ request('filter') ?: $today }}">
                    <button class="btn btn-warning" type="submit">
                        <i class="bx bx-search"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Tombol Cetak -->
            <a class="btn btn-secondary mb-3" target="_blank"
                href="/dashboard/cetak{{ request()->has('filter') ? '?filter=' . request('filter') : '' }}">
                <i class="bx bx-printer"></i> Cetak
            </a>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0 text-center">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pukul</th>
                            <th scope="col">Suhu Air</th>
                            <th scope="col">TDS (PPM)</th>
                            <th scope="col">pH Air</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($controls as $control)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($control->timestamp)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($control->timestamp)->format('H:i') }}</td>
                                <td>{{ $control->temperature }} °C</td>
                                <td>{{ $control->tds }} PPM</td>
                                <td>{{ $control->ph }}</td>
                                <td>
                                    <form action="/dashboard/histories/{{ $control->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
