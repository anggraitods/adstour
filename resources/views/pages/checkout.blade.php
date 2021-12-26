@extends('layouts.checkout')
@section('title', 'Checkout')


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
                            <li class="breadcrumb-item">
                                Details
                            </li>
                            <li class="breadcrumb-item active">
                                Checkout
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>

            <!-- script membuat row baru -->
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>                            
                        @endif
                        <h1>Siapa yang ingin liburan ?</h1>
                        <p>
                            Perjalanan wisata ke {{ $item->travel_package->judul }}, {{ $item->travel_package->lokasi }}
                        </p>
                        <!-- Script untuk bagian mulai foto  -->
                        <div class="peserta">
                            <table class="table table-responsive-sm text-center">
                                <thead>
                                    <tr>
                                        <td>Gambar</td>
                                        <td>Nama</td>
                                        <td>Kewarganegaraan</td>
                                        <td>VISA</td>
                                        <td>Passport</td>
                                        <td></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($item->details as $detail)
                                    <tr>
                                        <td>
                                            <img src="https://ui-avatars.com/api/?name={{ $detail->username }}" height="60" class="rounded-circle" />
                                        </td>
                                        <td class="align-middle">
                                            {{ $detail->username }}
                                        </td>

                                        <td class="align-middle">
                                            {{ $detail->kewarganegaraan }}
                                        </td>

                                        <td class="align-middle">
                                            {{ $detail->is_visa ? '60 Hari' : 'N/A'}}
                                        </td>

                                        <td class="align-middle">
                                            {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Active' : 'Inactive'}}
                                        </td>

                                        <td class="align-middle">
                                            <a href="{{ route('checkout-remove', $detail->id) }}">
                                                <img src="{{ url('frontend/images/avatar/ic_remove.png') }}" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No Visitor
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="member mt-3">
                            <h2>Tambah Anggota</h2>
                            <!-- Menggunakan form inline bawaan boostrap  -->
                            <form class="form-inline" method="POST" action="{{ route('checkout-create', $item->id) }}">
                                @csrf
                                <label for="username" class="sr-only">Nama</label>
                                <input type="text" name="username" class="form-control mb-2 mr-sm-2" required id="username" placeholder="Username" />

                                <label for="kewarganegaraan" class="sr-only">Kewarganegaraan</label>
                                <input type="text" name="kewarganegaraan" class="form-control mb-2 mr-sm-2" required style="width: 50px" id="kewarganegaraan" placeholder="Kewarganegaraan" />

                                <label for="is_visa" class="sr-only">Visa</label>
                                <select name="is_visa" id="is_visa" required class="custom-select mb-2 mr-sm-2">
                                    <option value="" selected>VISA</option>
                                    <option value="1">60 hari</option>
                                    <option value="0">N/A</option>
                                </select>

                                <!-- script memasukkan datepicker -->
                                <label for="doe_passport" class="sr-only">DOE Passport</label>

                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="text" class="form-control datepicker" name="doe_passport" id="doe_passport" placeholder="DOE Passport">
                                </div>

                                <button type="submit" class="btn btn-add-now mb-2 px-4">
                                    TAMBAH
                                </button>
                            </form>
                            <h3 class="mt-2 mb-0">Note</h3>
                            <p class="disclaimer mb-0">
                                Anda hanya bisa melakukan invite ke anggota yang sudah register di ADSTour
                            </p>
                        </div>
                    </div>
                </div>

                <!-- script sebelah kotak sebelah kanan -->
                <div class="col-lg-4">
                    <!-- Script card sebelah kanan -->
                    <div class="card card-details card-right">
                        <h2>Informasi Checkout</h2>
                        <table class="informasi-perjalanan">
                            <tr>
                                <th width="50%">Anggota</th>
                                <td width="50%" class="text-right">
                                    {{ $item->details->count() }} orang
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Perpanjangan Visa</th>
                                <td width="50%" class="text-right">
                                   {{ $item->additional_visa }},00
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Harga Perjalanan</th>
                                <td width="50%" class="text-right">
                                   {{ $item->travel_package->harga }},00 / orang
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Total Harga</th>
                                <td width="50%" class="text-right">
                                    {{ $item->transaction_total }},00
                                </td>
                            </tr>

                            <tr>
                                <th width="50%">Total Bayar (+ Unik)</th>
                                <td width="50%" class="text-right text-total">
                                    <span class="text-blue">{{ $item->transaction_total }},</span>
                                    <span class="text-orange">{{ mt_rand(0,99) }}</span>
                                </td>
                            </tr>


                        </table>
                        <hr/>

                        <h2>Cara Pembayaran</h2>
                        <p class="instruksi-bayar">
                            Kamu akan masuk ke halaman pembayaran dengan menggunakan Go-Pay
                        </p>
                        <img src="{{ url('frontend/images/gopay/gopay.png') }}" class="w-50">
                        {{-- <div class="bank">
                            <div class="bank-item pb-3">
                                <img src="{{ url('frontend/images/avatar/ic_bank.png')}}" alt="" class="bank-image">
                                <div class="penjelasan">
                                    <h3>PT. ADSTour Indonesia</h3>
                                    <p>
                                        Bank Central Asia<br/>
                                        0889 6785 6645
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="bank-item pb-3">
                                <img src="{{ url('frontend/images/avatar/ic_bank.png')}}" alt="" class="bank-image">
                                <div class="penjelasan">
                                    <h3>PT. ADSTour Indonesia</h3>
                                    <p>
                                        Bank Jawa Tengah<br/>
                                        0998 8754 2456
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>


                        </div> --}}

                    </div>
                    <div class="join-container">
                        <a href="{{ route('checkout-success', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
                            Sudah Membayar
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">
                            Cancel Booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css')}}">
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <!-- script buat manggil xzoom -->
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4.6.0',
                icons: {
                    rightIcon: '<img src="{{ url ('frontend/images/avatar/ic_doe.png')}}"/>'
                }
            });
        });
    </script>
@endpush