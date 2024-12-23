{{-- Panggil file jquery untuk proses realtime --}}
<script type="text/javascript" src="{{ asset('jquery/jquery.min.js') }}"></script>

{{-- Ajax untuk realtime selama 2 menit --}}
<script type="text/javascript">
    $(document).ready(function() {
        let duration = 120000; // Durasi 2 menit dalam milidetik
        let interval = 1000; // Interval pembaruan 1 detik
        let elapsed = 0; // Waktu yang telah berjalan

        const intervalId = setInterval(function() {
            if (elapsed >= duration) {
                clearInterval(intervalId); // Hentikan pembaruan setelah 2 menit
            } else {
                $("#suhu").load("{{ url('bacasuhu') }}");
                $("#kekeruhan").load("{{ url('bacatds') }}"); // Ubah ke endpoint yang relevan
                $("#ph").load("{{ url('bacaph') }}");
                elapsed += interval;
            }
        }, interval);
    });
</script>