@extends('auth.app')

@section('title','Regsiter')

@section('style')
<style>
    .form-login {
        margin: auto;
        position: relative;
        width: 100%;
    }

    form {
        margin-left: 16%;
        position: relative;
    }

    form input,
    .custom-file-input {
        display: block;
        margin: 10px 5px;
        width: 70%;
    }

    img {
        width: 100%;
    }

    @media screen and (max-width:767px) {
        img {
            width: 0;
            margin-left: 20%;
        }
    }
</style>
@endsection


@section('content')
@if(session('eror'))
<div class="alert alert-danger" role="alert">
    {{ session('eror') }}
</div>
@endif

<div class="row mt-5">
    <div class="col-lg-5">
        <h1 class="text-center title mt-2">REGISTER</h1>
        <div class="form-login">
            <form action="postRegister" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="name" class="mt-2">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" value="{{ old('name')}}" id="name">
                @error('name')
                <div class="ml-2 invalid-feedback d-block">
                    {{ $message}}
                </div>
                @enderror
                <label for="email" class="mt-2">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="{{ old('email')}}" id="email">
                @error('email')
                <div class="ml-2 invalid-feedback d-block">
                    {{ $message}}
                </div>
                @enderror
                <label for="password" class="mt-2">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{ old('password')}}" id="password">
                @error('password')
                <div class="ml-2 invalid-feedback d-block">
                    {{ $message}}
                </div>
                @enderror
                <label for="password2" class="mt-2">Confirm Password</label>
                <input type="password" name="password2" class="form-control" placeholder="Re-type Your password" id="password">
                @error('password2')
                <div class="ml-2 invalid-feedback d-block">
                    {{ $message}}
                </div>
                @enderror
                <label for="image" class=" mt-2">Pilih Gambar</label>
                <div class="custom-file">
                    <input type="file" name="profile-image" class="custom-file-input" id="image">
                    <label class="custom-file-label form-control" for="iamge">Pilih Gambar</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <a href="/login" class="btn btn-success mt-3 ml-4">Login</a>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <img src="/img/3226801.jpg" alt="">
    </div>
</div>

@endsection