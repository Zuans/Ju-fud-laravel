@extends('dashboard.app')

@section('title','Tambah Makanan')

@section('style')
<link rel="stylesheet" href="/css/tambahmakanan.css">
@endsection

@section('content')
<div class="container">
    <h1 class="title-page mt-4 ml-3">Tambah Makanan</h1>
    <hr class="hr-title  ml-3">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form action="{{ url('/dashboard/tambah')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Nama Makanan</label>
            <input type="text" class="form-control" id="title" value="{{ old('title')}}" name="title" placeholder="Masukkan Nama Makanan">
            @error('title')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" value="{{ old('price')}}" name="price" placeholder="Masukkan Harga Makanan ( Rp )">
            @error('price')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="Null">Pilih Category</option>
                <option value="Fast Food">Fast Food</option>
                <option value="Makanan Warteg">Makanan Warteg</option>
                <option value="Makanan Padang">Makanan Padang</option>
                <option value="Cookie">Cookies</option>
            </select>
            @if(session('error'))
            <div class="ml-2 invalid-feedback d-block">
                {{ session('error')}}
            </div>
            @endif
        </div>
        <div class="custom-file">
            <input type="file" name="image_src" class="custom-file-input" id="iamge">
            <label class="custom-file-label form-control" for="iamge">Pilih Gambar</label>
        </div>
        @error('image_src')
        <div class="ml-2 invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group mt-4">
            <label for="description">Deskripsi makanan</label>
            <textarea class="form-control" maxlength="50" id="description" value="{{ old('description')}}" name="description" placeholder="Masukkan Deskripsi Makanan" rows="3"></textarea>
            @error('description')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection