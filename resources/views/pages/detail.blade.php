@extends('layouts.app')
@section('title', 'Detail Travel')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col p-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Paket Travel
                            </li>
                            <li class="breadcrumb-item active">
                                Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- script membuat row baru -->
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        <h1>{{ $item->judul }}</h1>
                        <p>
                            {{ $item->lokasi }}
                        </p>
                        @if($item->galleries->count())
                            <div class="gallery">
                                <div class="xzoom-container">
                                    <img src="{{ Storage::url($item->galleries->first()->image) }}" class="xzoom" id="xzoom-default" xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                                </div>

                                <div class="xzoom-thumbs">
                                    @foreach ($item->galleries as $gallery)
                                        <a href="{{ Storage::url($gallery->image) }}">
                                            <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery" width="128" xpreview="{{ Storage::url($gallery->image) }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <h2>Tentang Objek Wisata</h2>
                                <p>
                                    {!! $item->isi !!}
                                </p>
                        <div class="features row">
                            <div class="col-md-4">
                                <div class="description">
                                    <img src="{{ url('frontend/images/featured/featured1.png') }}" alt="" class="features-image">
                                        <div class="description">
                                            <h3>FEATURED EVENT</h3>
                                            <p>{{ $item->event_penting }}</p>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                    <img src="{{ url('frontend/images/featured/featured2.png') }}" alt="" class="features-image">
                                        <div class="description">
                                            <h3>LANGUAGE</h3>
                                            <p>{{ $item->bahasa }}</p>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                    <img src="{{ url('frontend/images/featured/featured3.png') }}" alt="" class="features-image">
                                    <div class="description">
                                        <h3>FOOD</h3>
                                        <p>{{ $item->makanan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- script sebelah kotak sebelah kanan -->
                <div class="col-lg-4">
                    <!-- Script card sebelah kanan -->
                    <div class="card card-details card-right">
                        <h2>Anggota yang berlibur</h2>
                        <div class="members my-2">
                            <img src="{{ url('frontend/images/members/member1.png') }}" class="member-image mr-1">

                            <img src="{{ url('frontend/images/members/member2.png') }}" class="member-image mr-1">

                            <img src="{{ url('frontend/images/members/member3.png') }}" class="member-image mr-1">

                            <img src="{{ url('frontend/images/members/member4.png') }}" class="member-image mr-1">

                            <img src="{{ url('frontend/images/members/member5.png') }}" class="member-image mr-1">

                            <img src="{{ url('frontend/images/members/member6.png') }}" class="member-image mr-1">
                        </div>
                        <hr>
                        <h2>Informasi Perjalanan</h2>
                        <table class="informasi-perjalanan">
                            <tr>
                                <th width="50%">Tanggal Keberangkatan</th>
                                <td width="50%" class="text-right">
                                    {{ \Carbon\Carbon::create($item->date_of_departure)->format('F n, Y') }}
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Durasi waktu</th>
                                <td width="50%" class="text-right">
                                    {{ $item->durasi }}
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Jenis Perjalanan</th>
                                <td width="50%" class="text-right">
                                    {{ $item->jenis }}
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Harga</th>
                                <td width="50%" class="text-right">
                                    {{ $item->harga }},00 / person
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="join-container">
                        @auth
                            <form action="{{ route('checkout_process', $item->id) }}" method="post">
                                @csrf
                                <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                                    Gabung Sekarang
                                </button>
                            </form>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                                Login atau Register untuk Join
                            </a>   
                        @endguest
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css')}}">
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <!-- script buat manggil xzoom -->
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                xoffset: 15
            });
        });
    </script>
    
@endpush