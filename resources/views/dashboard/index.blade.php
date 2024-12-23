@extends('dashboard.layouts.main')

@section('container')
    <style>
        .text-custom-red {
            color: #000;
        }

        .icon-custom-red {
            color: #384B70;
        }
    </style>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa-solid fa-temperature-low fa-2xl icon-custom-red"></i>
                    <div class="ms-3">
                        <p class="mb-2">Suhu Air</p>
                        <h6 class="mb-0"><span id="suhu">{{ $latestData->temperature ?? '0' }}</span> °C</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa-solid fa-water fa-2xl icon-custom-red"></i>
                    <div class="ms-3">
                        <p class="mb-2">TDS</p>
                        <h6 class="mb-0"><span id="tds">{{ $latestData->tds ?? '0' }}</span> PPM</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa-solid fa-hand-holding-droplet fa-2xl icon-custom-red"></i>
                    <div class="ms-3">
                        <p class="mb-2">pH Air</p>
                        <h6 id="ph" class="mb-0">{{ $latestData->ph ?? '0' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Riwayat Monitoring Terbaru</h6>
                <a href="/dashboard/controls" class="text-custom-red">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-custom-red">
                            <th scope="col">Tanggal</th>
                            <th scope="col">Pukul</th>
                            <th scope="col">Suhu Air</th>
                            <th scope="col">TDS</th>
                            <th scope="col">pH Air</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $data)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($data->timestamp)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->timestamp)->format('H:i') }}</td>
                                <td>{{ $data->temperature }} °C</td>
                                <td>{{ $data->tds }} PPM</td>
                                <td>{{ $data->ph }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    async function fetchData() {
        try {
            // Fetch data dari API
            const response = await fetch('/api/sensor-data');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            // Update real-time data
            document.getElementById('temperature').textContent = data.temperature || 0;
            document.getElementById('tds').textContent = data.tds || 0;
            document.getElementById('ph').textContent = data.ph || 0;

            // Update tabel riwayat
            const tableBody = document.querySelector('tbody');
            tableBody.innerHTML = ''; // Kosongkan tabel

            if (data.history && data.history.length > 0) {
                data.history.forEach((entry) => {
                    const row = `
                        <tr>
                            <td>${new Date(entry.timestamp).toLocaleDateString()}</td>
                            <td>${new Date(entry.timestamp).toLocaleTimeString()}</td>
                            <td>${entry.temperature} °C</td>
                            <td>${entry.tds} PPM</td>
                            <td>${entry.ph}</td>
                        </tr>`;
                    tableBody.innerHTML += row;
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="5">Tidak ada data</td></tr>';
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // Refresh data setiap 5 detik
    setInterval(fetchData, 5000);

    // Fetch data pertama kali saat halaman dimuat
    fetchData();
</script>

@endsection
