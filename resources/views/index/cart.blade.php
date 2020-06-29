@extends('index.app')

@section('title','Cart')

@section('style',)
<link rel="stylesheet" href="/css/cart.css">
@endsection

@section('content')
<div class="container">
    <h1 class="mt-5 text-center">Cart</h1>
    <hr style="border: 1.5px solid black" class="mt-4">
    @if(!session('login'))
    <div class="d-flex justify-content-center">
        <img src="/img/asuna-angry.jpg" class="img-0" alt="">
    </div>
    <div class="d-flex justify-content-center mt-5">
        <div class="alert alert-danger text-center d-block" style="width: 50%;" role="alert">
            Kamu Belum Login !
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/login" class="btn btn-primary justify-content-center d-block">Login!</a>
    </div>
    @elseif($foods->count() == 0 )
    <div class="d-flex justify-content-center">
        <img src="/img/asuna-angry.jpg" class="img-0" alt="">
    </div>
    <div class="d-flex justify-content-center mt-5">
        <div class="alert alert-danger text-center d-block" style="width: 50%;" role="alert">
            Keranjang kamu kosong !
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="/" class="btn btn-primary justify-content-center d-block">Cari makanan</a>
    </div>

    @else
    @foreach( $foods as $food )
    <div class="container">
        <div class="food mt-5">
            <form action="/delete/food/{{ $food->id }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger float-right btn-close"><i class="fas fa-times"></i></button>
            </form>
            <div class="row mt-5">
                <div class="col-lg-4">
                    <img class="ml-3" src="storage/images/{{ $food->image_src }}" alt="">
                </div>
                <div class="col-lg-8 ">
                    <h5 class="card-title card-text text-white">Nama Produk: {{$food->title}}</h5>
                    <p class="card-text text-white">Harga/Pcs: {{$food->price}}</p>
                    <p class="card-text text-white">Jumlah: {{$food->jumlah}}</p>
                    <a href="/show/{{ $food->food_id }}" class="btn btn-dark">Ubah Jumlah </a>
                    <hr width="100%" class="text-left">
                    <p class="card-text text-white d-inline ">Total:&nbsp;Rp</p>
                    <p class="card-text text-white d-inline total-barang">{{$food->total}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="total mt-5 p-5 ">
        <h1 class="d-inline total-harga">Total Harga:Rp</h1>
        <h1 class="d-inline total-harga" id="total">0</h1>
    </div>
    <a href="/" class="btn btn-primary d-inline ml-5">Cari Makanan lagi</a>
    <button type="submit" id="btn-pay" class="btn btn-success d-inline">Lanjut Pembayaran</button>
    @endif
</div>
@endsection

@section('script')
<script type="module" src="/js/cart.js"></script>
@endsection