@extends('layouts.app')

@section('title')
ADSTour
@endsection

@section('content')
<!-- script header -->
<header class="text-center">
    <h1>Eksplorasi keindahan dunia
        <br />
        Semudah dengan 1 klik</h1>
    <p class="mt-3">
        kamu akan melihat keindahan
        <br/>
        momen yang belum pernah anda liat sebelumnya
    </p>
    <a href="#popular" class="btn btn-get-started px-4 mt-4">
        Mulai
    </a>
</header>

<!-- script untuk 4 kolom bawah header bagian utama-->
<main>
    <div class="container">
        <section class="section-stats row justify-content-center" id="stats">
            <!-- script 4 kolom -->
            <div class="col-3 col-md-2 stats-detail">
                <h2>20K</h2>
                <p>ANGGOTA</p>
            </div>

            <div class="col-3 col-md-2 stats-detail">
                <h2>12</h2>
                <p>NEGARA</p>
            </div>

            <div class="col-3 col-md-2 stats-detail">
                <h2>3K</h2>
                <p>HOTEL</p>
            </div>

            <div class="col-3 col-md-2 stats-detail">
                <h2>72</h2>
                <p>MITRA</p>
            </div>
        </section>
    </div>

    <!-- Script untuk div background popular -->
    <section class="section-popular" id="popular">
        <div class="container">
            <div class="row">
                <div class="col text-center section-popular-heading">
                    <h2>Wisata Terpopuler</h2>
                    <p>Pesona keindahan tak terlupakan,<br/>
                        kunjungi salah satu destinasi terbaik dunia ini
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- script foto popular -->
    <section class="section-popular-content" id="popularContent">
        <div class="container">
            <div class="section-popular-travel row justify-content-center">

                <!-- ======================================================================================= -->
                <!-- script potongan foto popularnya -->
                @foreach ($items as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column" style="background-image:url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">
                            <div class="travel-country">{{ $item->lokasi }}</div>
                            <div class="travel-location">{{ $item->judul }}</div>
                            <div class="travel-button mt-auto">
                                <a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-explorer px-4">
                                    Explorer
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- script untuk jaringan dan logonya -->
    <section class="section-jaringan" id="jaringan">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Jaringan Kami</h2>
                    <p>
                        Perusahaan kepercayaan kami,<br/> 
                        lebih dari sebuah perjalanan
                    </p>
                </div>

                <!-- script logo jaringan -->
                <div class="col-md-8 text-center">
                    <img src="frontend/images/jaringan/logo_jaringan.png" alt="Logo Partner" class="img-jaringan">
                </div>
            </div>
        </div>
    </section>

    <!-- script untuk testimonial -->
    <section class="section-testimonial-heading" id="testimonialheading">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>Mereka Mempercayai Kami</h2>
                    <p>Moment yang mereka bagikan,<br/>
                        menjadikan pengalaman terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- script memasukkan foto -->
    <section class="section section-testimonial-content" id="testimonialContent">
        <div class="container">
            <div class="section-popular-travel row justify-content-center">

                <!-- ==================================================================== -->
                <!-- script testimonial kotak-kotak -->
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card card-testimonial text-center">
                        <div class="testimonial-content">
                            <img src="/frontend/images/testimonial/testi1.png" alt="User" class="mb-4 rounded-circle">
                            <h3 class="mb-4">Anggraito Dwi Suharto</h3>
                            <p class="testimonial"> " I love it when visited<br/> 
                                                    here first time.<br/>
                                                    I want to visit for this<br/> 
                                                    beautiful place again love it. "
                            </p>
                        </div>

                        <hr>

                        <p class="trip-to mt-2">
                            Trip ke Borobudur, Jateng
                        </p>
                    </div>
                </div>
                <!-- ==================================================================== -->

                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card card-testimonial text-center">
                        <div class="testimonial-content">
                            <img src="/frontend/images/testimonial/testi2.png" alt="User" class="mb-4 rounded-circle">
                            <h3 class="mb-4">Indah Permata Sari</h3>
                            <p class="testimonial"> " The trip was amazing and<br/>
                                                    I saw something beautiful in<br/>
                                                    that island that makes me<br/>
                                                    want to learn more "
                            </p>
                        </div>

                        <hr>

                        <p class="trip-to mt-2">
                            Trip Labuan Bajo, NTB
                        </p>
                    </div>
                </div>

                <!-- ==================================================================== -->

                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card card-testimonial text-center">
                        <div class="testimonial-content">
                            <img src="/frontend/images/testimonial/testi3.png" alt="User" class="mb-4 rounded-circle">
                            <h3 class="mb-4">Rita Kusuma</h3>
                            <p class="testimonial">  " I love it when the waves<br/>
                                                        was shaking harder - I was<br/>
                                                        scared too "
                            </p>
                        </div>

                        <hr>

                        <p class="trip-to mt-2">
                            Trip ke Danau Toba, Medan
                        </p>
                    </div>
                </div>

                <!-- ==================================================================== -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="#" class="btn btn-butuh-bantuan px-4 mt-4 mx-1">
                        Bantuan 
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-mulai px-4 mt-4 mx-1">
                        Mulai
                    </a>


                </div>
            </div>
        </div>
    </section>
</main>

@endsection