@extends('layouts.success')
@section('title', 'Checkout Success')


@section('content')
<main>
    <div class="section-success d-flex align-items-center">
        <div class="col text-center">
            <img src="{{ url('frontend/images/avatar/ic_mail.png') }}" alt="" />
            <h1>Yeaahh, Anda Telah Berhasil !!!</h1>
            <p>
                Kami telah mengirimkan email petunjuk perjalanan,<br/> 
                silahkan dicek dan dibaca seksama
            </p>
            <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">
                Halaman Utama
            </a>
        </div>
    </div>
</main>

@endsection
