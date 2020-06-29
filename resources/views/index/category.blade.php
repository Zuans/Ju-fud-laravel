@extends('index.app')

@section('title','Category')

@section('style')
<link rel="stylesheet" href="/css/welcome.css">
@endsection

@section('content')
<section id="item">
    <div class="container">
        <h1 class="text-center">{{ $cate }}</h1>
        <hr class="text-center hr-title">
        <div class="row mt-5">
            @foreach( $datas as $data )
            <div class="card col-lg-3 mx-auto ml-5 mt-4 p-4 " style="width: 20rem;">
                <img class="card-img-top img-food mt-3 " src="/storage/images/{{ $data->image_src}}" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title text-center text-white ">{{ $data->title }}</h5>
                    <p class="card-text text-center text-white">{{ $data->category }}</p>
                    <p class="card-text text-center text-white">Rp.{{ $data->price }}</p>
                    <a href="/show/{{ $data->id }}" class="btn btn-primary text-white">Go somewhere</a>
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