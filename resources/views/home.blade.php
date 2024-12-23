@extends('layouts.main')

@section('container')

<style>
    .btn-custom-red {
        background-color: #B8001F; /* Custom red color */
        color: white;
    }

    .btn-custom-red:hover {
        background-color: #B8001F; /* Darker shade on hover */
    }
</style>

<section class="pt-7">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center py-6">
                <h1 class="mb-4 fs-9 fw-bold">Pengenalan jenis ikan Koi & Monitoring kualitas air  </h1>
                <p class="mb-6 lead text-secondary">Website pengenalan jenis ikan Koi &<br
                    class="d-none d-xl-block" />Kualitas Air Untuk Kolam Ikan Koi<br</p>
                <div class="text-center text-md-start">
                    <a class="btn btn-custom-red me-3 btn-lg" href="/dashboard" role="button">Mulai Monitoring</a>
                </div>
            </div>
            <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="{{ asset('landpage/assets/img/hero/logo1.png') }}"
                alt="" /></div>
        </div>
    </div>
</section>

@endsection