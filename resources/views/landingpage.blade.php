@extends('layouts.main')

@section('container')

<!-- ======== preloader start ======== -->
<div class="preloader">
    <div class="loader">
        <div class="spinner">
            <div class="spinner-container">
                <div class="spinner-rotator">
                    <div class="spinner-left">
                        <div class="spinner-circle"></div>
                    </div>
                    <div class="spinner-right">
                        <div class="spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- preloader end -->

<!-- ======== hero-section start ======== -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="wow fadeInUp" data-wow-delay=".4s">
                        Smart System for Koi Species Recognition and Water Quality
                        Monitoring
                    </h1>
                    <p class="wow fadeInUp" data-wow-delay=".6s">
                        Kenali Keindahan Setiap Jenis Koi dan Pantau Kesehatan Air di
                        Kolam Anda Secara Real-Time
                    </p>
                    <a href="/dashboard" class="main-btn border-btn btn-hover wow fadeInUp" data-wow-delay=".6s">Coba
                        Sekarang!</a>
                    <!-- <a href="#features" class="scroll-bottom">
                <i class="lni lni-arrow-down"></i
              ></a> -->
                </div>
            </div>
            <!-- <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
              <img src="assets/img/hero/hero-img.png" alt="" />
            </div>
          </div> -->
        </div>
    </div>
</section>
<!-- ======== hero-section end ======== -->

<!-- ======== feature-section start ======== -->
<section id="features" class="feature-section pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-grid-alt"></i>
                    </div>
                    <div class="content">
                        <h3>Pengenalan Ikan Koi</h3>
                        <p>
                            Menggunakan model kecerdasan buatan untuk mengenali spesies
                            ikan Koi dengan tingkat akurasi tinggi.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-layout"></i>
                    </div>
                    <div class="content">
                        <h3>Monitoring Kualitas Air</h3>
                        <p>
                            Memantau berbagai indikator penting seperti pH, suhu, TDS,
                            secara Real-Time.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-coffee-cup"></i>
                    </div>
                    <div class="content">
                        <h3>Mudah Digunakan</h3>
                        <p>
                            Sistem dapat diakses melalui perangkat apa pun yang memiliki
                            browser, baik desktop maupun mobile.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-leaf"></i>
                    </div>
                    <div class="content">
                        <h3>Pengambilan Keputusan</h3>
                        <p>
                            Menyediakan grafik dan laporan historis untuk membantu
                            pengguna memahami kondisi kolam secara menyeluruh.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-rocket"></i>
                    </div>
                    <div class="content">
                        <h3>Akses Jarak Jauh</h3>
                        <p>
                            Pengguna dapat memantau kualitas air kolam ikan koi dari jarak
                            jauh melalui perangkat web/mobile.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10">
                <div class="single-feature">
                    <div class="icon">
                        <i class="lni lni-layers"></i>
                    </div>
                    <div class="content">
                        <h3>Inovatif dan Modern</h3>
                        <p>
                            Menggabungkan AI, IoT, dan teknologi web untuk memberikan
                            solusi yang canggih.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== feature-section end ======== -->

<!-- ======== about-section start ======== -->
<section id="about" class="about-section pt-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="about-img">
                    <img src="{{ asset('assets/img/about/Shot-3.png') }}" alt="" class="w-100" />
                    <img src="{{ asset('assets/img/about/left-dots.svg') }}" alt="" class="shape shape-1" />
                    <img src="{{ asset('assets/img/about/left-dots.svg') }}" alt="" class="shape shape-2" />
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="about-content">
                    <div class="section-title mb-30">
                        <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                            Unduh Aplikasi Mobile versi Android Sekarang!
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Nikmati pengalaman terbaru dalam mengelola kolam ikan Koi Anda
                            dengan mudah melalui aplikasi mobile kami. Pantau kualitas air
                            secara real-time, dapatkan notifikasi penting, dan
                            identifikasi jenis ikan Koi langsung dari ponsel Anda. Dengan
                            fitur lengkap dan antarmuka yang intuitif, aplikasi ini
                            dirancang untuk mendukung hobi dan bisnis Anda. Segera unduh
                            dan rasakan kemudahannya!
                        </p>
                    </div>
                    <a href="app-release.apk" download="app-release.apk"
                        class="main-btn btn-hover border-btn wow fadeInUp" data-wow-delay=".6s">Unduh Sekarang!</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== about-section end ======== -->

<!-- ======== feature-section start ======== -->
<section id="why" class="feature-extended-section pt-100">
    <div class="feature-extended-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-xl-10 col-lg-10 col-md-12">
                    <div class="section-title text-center mb-60">
                        <h2 class="mb-25 wow fadeInUp" data-wow-delay=".2s">
                            Frequently Asked Questions
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Berikut adalah beberapa pertanyaan yang sering diajukan oleh
                            pengguna.
                        </p>
                    </div>
                </div>
            </div>

            <button class="accordion">
                1. Apa itu sistem pengenalan jenis ikan Koi dan monitoring kualitas
                air kolam?
            </button>
            <div class="panel">
                <p style="font-size: medium">
                    Sistem ini adalah sebuah aplikasi berbasis web & mobile yang
                    memungkinkan pengguna untuk mengidentifikasi jenis ikan Koi
                    menggunakan teknologi AI dan memantau kualitas air kolam secara
                    real-time melalui sensor IoT.
                </p>
            </div>

            <button class="accordion">
                2. Apakah hasil pengenalan jenis ikan Koi akurat?
            </button>
            <div class="panel">
                <p style="font-size: medium">
                    Model AI yang digunakan telah dilatih dengan dataset besar berisi
                    berbagai jenis ikan Koi, sehingga memiliki tingkat akurasi tinggi.
                    Namun, hasil prediksi tetap bergantung pada kualitas gambar yang
                    diunggah.
                </p>
            </div>

            <button class="accordion">
                3. Bagaimana cara mendapatkan aplikasi ini?
            </button>
            <div class="panel">
                <p style="font-size: medium">
                    Aplikasi ini dapat diakses melalui platform web atau diunduh untuk
                    perangkat Android. Kunjungi halaman resmi kami untuk informasi
                    lebih lanjut.
                </p>
            </div>

            <button class="accordion">4. Apakah data saya aman?</button>
            <div class="panel">
                <p style="font-size: medium">
                    Kami menggunakan enkripsi untuk melindungi data Anda, dan semua
                    komunikasi dengan server dilakukan melalui protokol yang aman
                    (HTTPS). Data pengguna juga hanya digunakan untuk tujuan
                    pemrosesan dalam sistem ini.
                </p>
            </div>

            <!-- <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-display"></i>
                </div>
                <div class="content">
                  <h3>SaaS Focused</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-leaf"></i>
                </div>
                <div class="content">
                  <h3>Awesome Design</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-grid-alt"></i>
                </div>
                <div class="content">
                  <h3>Ready to Use</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-javascript"></i>
                </div>
                <div class="content">
                  <h3>Vanilla JS</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-layers"></i>
                </div>
                <div class="content">
                  <h3>Essential Sections</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="single-feature-extended">
                <div class="icon">
                  <i class="lni lni-rocket"></i>
                </div>
                <div class="content">
                  <h3>Highly Optimized</h3>
                  <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore
                  </p>
                </div>
              </div>
            </div>
          </div> -->
        </div>
    </div>
</section>
<!-- ======== feature-section end ======== -->


@endsection