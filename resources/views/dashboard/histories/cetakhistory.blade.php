<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Monitoring | {{ request('filter') ?: now()->format('Y-m-d') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-4">
        <h4 class="text-center">Rekap Data Monitoring</h4>
        <p class="text-center">Tanggal: {{ request('filter') ?: now()->format('d M Y') }}</p>
        <table class="table table-bordered text-center">
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
                        <td>{{ $control->created_at->format('H:i') }}</td>
                        <td>{{ $control->temperature }}</td>
                        <td>{{ $control->turbidity }}</td>
                        <td>{{ $control->ph }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
