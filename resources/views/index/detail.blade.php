@extends('index.app')


@section('title','Detail Makanan')

@section('style')
<link rel="stylesheet" href="/css/detail.css">
@endsection

@section('content')
<div class="container">
    @if(session('success'))
    <h1>{{ session('success')}}</h1>
    @endif
    <div class="jumbotron  mt-4">
        <div class="row">
            <div class="col-lg-4 ">
                <img src="/storage/images/{{ $food->image_src}}" class="food-img ml-5" alt="">
            </div>
            <div id="alert">
            </div>
            <div class="col-lg-8">
                <h1 class="ml-5 pb-2">{{ $food->title}}</h1>
                <hr>
                <div class="ml-5 d-inline">
                    <p class="d-inline deskripsi ">ID Makanan:</p>
                    <P class="d-inline deskripsi" id="id">{{ $food->id }}</P>
                    <br>
                    <p class="d-inline deskripsi ml-5 ">Price:</p>
                    <P class="d-inline deskripsi" id="harga">{{ $food->price }}/Pcs</P>
                    <br>
                    <p class="d-inline deskripsi ml-5 mt-2 ">Category:</p>
                    <P class="d-inline deskripsi">{{ $food->category }}</P>
                    <br>
                    <p class="d-inline deskripsi ml-5 mt-2 ">Deskripsi</p>
                    <p class="deskripsi ml-5 mt-1 pl-2"><i class="fas fa-angle-double-right pr-2"></i>{{ $food->description }}</p>
                </div>
                <br>
                <div class="jumlah mt-2 ">
                    <button class="btn btn-danger ml-5 d-inline" id="kurang"><i class="fas fa-minus"></i></button>
                    <input type="number" name="jumlah" value="{{ $cart_food->jumlah ?? 0  }}" maxlength="3" class="d-inline ml-2 mr-2" id="jumlah">
                    <button class="btn btn-primary  d-inline" id="tambah"><i class="fas fa-plus"></i></button>
                </div>
                <div class="total ml-5 mt-2">
                    <h1 class="d-inline">Total:Rp</h1>
                    <h1 class="d-inline" id="total">{{ $cart_food->total ?? 0  }}</h1>
                </div>
                {{ csrf_field() }}
                <button class="btn btn-primary ml-5 mt-2" id="btn">Masuk Keranjang</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/js/detail.js"></script>
@endsection