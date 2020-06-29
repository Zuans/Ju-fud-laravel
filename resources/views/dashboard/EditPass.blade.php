@extends('dashboard.app')

@section('title','Edit Profile')

@section('style')
<style>
    .form-control {
        width: 80%;
    }

    .caption-img {
        font-size: 1.3rem;
        font-weight: 600;
        text-shadow: 1px 1px 5px grey;
    }

    .img-alice {
        margin-left: 20%;
        position: relative;
    }

    @media screen and (min-width:768px) {
        .grid {
            display: grid;
            width: 90%;
            grid-template-columns: 1.4fr 1fr;
            grid-template-rows: 1fr;
        }

        .part-1 {
            display: grid;
            grid-row-start: 1 / 2;
            grid-column-start: 1 / 2;

        }


        form {
            padding: 20px;
            padding-right: 0px;
            box-shadow: 5px 5px 27px rgb(162, 164, 168);
            box-sizing: border-box;
            border-radius: 10px;
            width: 65%;
            margin-top: 20px;
        }

        .part-2 {
            display: grid;
            grid-row-start: 1 /2;
            grid-column-start: 2/3;
        }

        html {
            overflow-y: hidden;
        }

    }

    @media screen and (max-width: 767px) {
        .form-control {
            width: 70%;
        }

    }
</style>
@endsection

@section('content')
<h1 class="title-page mt-4 ml-3">Edit Password</h1>
<hr class="hr-title   ml-3">
<div class="grid">
    <div class="part-1">
        <form action="/dashboard/admin/editPass/{{ $data->id }}" class="ml-4" method="POST">
            {{ csrf_field() }}
            @method('patch')
            <label for="passwordlama" class="mt-2">Old Password</label>
            <input type="password" name="passwordLama" class="form-control" placeholder="Old Enter Password" value="{{ old('passwordLama')}}" id="password">
            @error('passwordLama')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
            <label for="password" class="mt-2">New Password</label>
            <input type="password" name="password" class="form-control" placeholder=" New Enter Password" value="{{ old('password')}}" id="password">
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
            <input type="submit" class="btn btn-primary mt-3" value="Ubah">
        </form>
    </div>
    <div class="part-2 ml-5">
        <img src="/img/alice.jpg" class="img-alice" alt="">
        <p class="caption-img mt-2 ml-3">Jangan Sampai Lupa Password Yaaa Oni-chan</p>
    </div>
</div>
@endsection