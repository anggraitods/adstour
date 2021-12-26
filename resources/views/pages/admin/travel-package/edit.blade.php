@extends('layouts.admin')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Paket Travel {{ $item->title }}</h1>
            
        </div>

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            
        @endif
            
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('travel-package.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul" value="{{ $item->judul }}">
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" value="{{ $item->lokasi }}">
                    </div>

                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <textarea name="isi" rows="10" class="d-block w-100 form-control">{{ $item->isi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="event_penting">Event Penting</label>
                        <input type="text" class="form-control" name="event_penting" placeholder="Event Penting" value="{{ $item->event_penting }}">
                    </div>

                    <div class="form-group">
                        <label for="bahasa">Bahasa</label>
                        <input type="text" class="form-control" name="bahasa" placeholder="Bahasa" value="{{ $item->bahasa }}">
                    </div>

                    <div class="form-group">
                        <label for="makanan">Makanan</label>
                        <input type="text" class="form-control" name="makanan" placeholder="Makanan" value="{{ $item->makanan }}">
                    </div>

                    <div class="form-group">
                        <label for="tgl_berangkat">Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" name="tgl_berangkat" placeholder="Tanggal Berangkat" value="{{ $item->tgl_berangkat }}">
                    </div>

                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control" name="durasi" placeholder="Durasi" value="{{ $item->durasi }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <input type="text" class="form-control" name="jenis" placeholder="Jenis" value="{{ $item->jenis }}">
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="Harga" value="{{ $item->harga }}">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    
@endsection