<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Data Monitoring</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="title">
        <h3>Rekap Data Monitoring</h3>
        <p>Tanggal: {{ $filterDate ? \Carbon\Carbon::parse($filterDate)->format('d M Y') : 'Semua Data' }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Pukul</th>
                <th>Suhu Air (°C)</th>
                <th>TDS (PPM)</th>
                <th>pH Air</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($controls as $control)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($control->timestamp)->format('H:i') }}</td>
                    <td>{{ $control->temperature }}</td>
                    <td>{{ $control->tds }}</td>
                    <td>{{ $control->ph }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
