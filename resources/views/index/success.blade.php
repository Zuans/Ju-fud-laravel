@extends('index.app')

@section('title','Success')

@section('style')
<link rel="stylesheet" href="/css/success.css">
@endsection

@section('content')
<div class="container">
    <div class="success text-center pb-5  mt-5">
        <h3 class="text-center mt-5">Pembelian kamu berhasil!</h3>
        <p class="text-center">Terimakasih telah memakai layanan kami</p>
        <a href="/" class="btn text-center btn-primary">Back to home</a>
    </div>
</div>
@endsection