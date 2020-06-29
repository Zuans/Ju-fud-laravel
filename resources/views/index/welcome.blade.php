@extends('index.app')

@section('title','Home')

@section('style')
<link rel="stylesheet" href="/css/welcome.css">
@endsection

@section('content')
<div class="container-fluid mt-5">
    <div class="jumbotron ">
        <h1 class='text-center mt-5'>Hey,Welcome</h1>
        <p class='text-center'>Thanks For you visit</p>
        <p class="text-center">Develop By <a href="#" class="my-href">Zuans</a></p>
    </div>
</div>

<div class="container bg-dark benefit-container">
    <h1 class="text-white text-center pt-4">Kenapa harus Ju-fud ?</h1>
    <div class="row pr-5">
        <div class="col-1 d-flex  align-items-top py-4">
            <h3 class="text-left  ml-5 "><i class="fas fa-truck text-white"></i></h3>
        </div>
        <div class="col-3 py-4 ">
            <h4 class=" ml-4 text-white ">Antar kerumah</h4>
            <p class="ml-4 text-white">Ju-fud menyediakan fitur antar dengam mneggunakan traktor</p>
        </div>
        <div class="col-1 d-flex   align-items-top py-4">
            <h3 class="text-left  ml-5 "><i class="fas fa-stopwatch text-white"></i></h3>
        </div>
        <div class="col-3 py-4 ">
            <h4 class=" ml-4 text-white ">Cepat dan mantab</h4>
            <p class="ml-4 text-white">Kami menggunakan traktor sebagai alat antar barang kerumah anda</p>
        </div>
        <div class="col-1 d-flex   align-items-top py-4">
            <h3 class="text-left  ml-5 "><i class="fas fa-utensils text-white"></i></i></h3>
        </div>
        <div class="col-3 py-4 ">
            <h4 class=" ml-4 text-white ">Makanan Berkualitas</h4>
            <p class="ml-4 text-white">Barang yang dijual disini merupakan barang dengan kualitas yang baik dan bersih dari kuman karena makanan dibersihkan menggunakan rinso sebelum dikirim</p>
        </div>
    </div>
</div>

<section id="item">
    <div class="container">
        <h1 class="text-center mt-5">All Food</h1>
        <hr class="text-center hr-title">
        <div class="row">
            @foreach( $datas as $data )
            <div class="card col-lg-3 ml-5 mt-4 p-4 mx-auto " style="width: 20rem;">
                <img class="card-img-top img-food mt-3 " src="storage/images/{{ $data->image_src}}" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title text-center text-white ">{{ $data->title }}</h5>
                    <p class="card-text text-center text-white">{{ $data->category }}</p>
                    <p class="card-text text-center text-white">Rp.{{ $data->price }}</p>
                    <a href="/show/{{ $data->id }}" class="btn btn-primary text-white">Lihat Detail</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $datas->links() }}
        </div>
    </div>
</section>
@endsection