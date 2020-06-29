@extends('index.app')

@section('title','Payment')

@section('style')
<link rel="stylesheet" href="/css/payment.css">
@endsection

@section('content')
@if($carts->count() == 0 )
<script>
    window.location.replace('/');
</script>
@endif
<div id="loader" class="loader">
    <span></span>
    <span></span>
    <span></span>
</div>
<div class="container">
    <div class="row mt-5">
        <div class="col-lg-8">
            <h1>Checkout</h1>
            <hr>
            <form action="" class="form-pay" method="get" id="payment-form">
                {{ csrf_field() }}
                <div class="row form-group">
                    <div class="col-lg-6">
                        <label class="mt-2" for="name">Nama Depan</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="mt-2" for="name2">Nama belakang </label>
                        <input type="text" class="form-control" name="name2" id="name2" required>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-lg-12">
                        <label class="mt-2" for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-lg-12">
                        <label class="mt-2" for="umur">Umur</label>
                        <input type="number" name="umur" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-lg-12">
                        <label class="mt-2" for="telp">No.Telp</label>
                        <input type="number" name="telp" class="form-control" id="telp" required>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-lg-12">
                        <label class="mt-2" for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="3" required rows="3"></textarea>
                    </div>
                </div>
                <label for="card-element">Checkout with credit card</label>
                <div id="card-element"></div>
                <div class="form-row">
                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <button class="btn btn-primary mt-4" id="btn" data-secret={{ $intent->client_secret }} type="submit">Submit</button>
            </form>
        </div>
        <div class="col-lg-4 ">
            <div class="container order item ">
                <h3 class="mt-3">Your Order</h1>
                    @foreach ($carts as $cart)
                    <div class="row  mt-4">
                        <div class="col-lg-6 col-md-6">
                            <img src="storage/images/{{ $cart->image_src }}" class="img-order" alt="">
                        </div>
                        <div class="col-lg-6 d-inline">
                            <p>Nama: {{ $cart->title }}</p>
                            <p>Jumlah: {{ $cart->jumlah }}</p>
                            <p class="d-inline">Sub Total:</p>
                            <p class="d-inline sub-total">{{ $cart->total }}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-2 pb-4 ">
                        <hr style="border: 1.7px solid black;">
                        <h4 class="ml-2 d-inline">Total Harga:</h4>
                        <h4 id="total-harga" class="d-inline"> {{ $user->total_price }}</h4>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')

<script src="https://js.stripe.com/v3/"></script>
<script src="/js/stripe.js"></script>
@endsection