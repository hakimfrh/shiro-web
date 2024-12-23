@extends('dashboard.layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #384B70;">
            <h5 style="color: #fff">Deteksi Jenis Ikan Koi</h5>
        </div>
        <div class="card-body">
            <form id="predictForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Unggah Foto Ikan Koi</label>
                    <input type="file" class="form-control" name="file" id="file" accept="image/*" required>
                </div>
                <button type="submit" class="btn w-100" style="background-color: #B8001F; color: #fff;">Deteksi</button>
            </form>
            <h2 class="mt-4">Hasil Prediksi:</h2>
            <div id="result" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    document.getElementById('predictForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const fileInput = document.getElementById('file');
        const file = fileInput.files[0];
        if (!file) {
            alert('Pilih gambar terlebih dahulu!');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);

        // Ambil CSRF token dari meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            console.error("CSRF token tidak ditemukan");
            alert("Token CSRF tidak ditemukan.");
            return;
        }

        try {
            // Kirim permintaan POST ke Laravel dengan CSRF token
            const response = await fetch('/classify-koi', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,  // Kirimkan token CSRF di header
                },
            });

            const data = await response.json();

            if (response.ok) {
                const { class_name, confidence } = data;

                document.getElementById('result').innerHTML = `
                    <div class="alert alert-success">
                        <p><strong>Kategori:</strong> ${class_name}</p>
                        <p><strong>Keyakinan:</strong> ${(confidence * 100).toFixed(2)}%</p>
                    </div>
                `;
            } else {
                const error = data.error || 'Tidak dapat memproses gambar.';
                document.getElementById('result').innerHTML = `
                    <div class="alert alert-danger">
                        <p>Error: ${error}</p>
                    </div>
                `;
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim gambar.');
        }
    });
</script>
@endsection
