@extends('auth.app')

@section('title','Login')


@section('style')
<style>
    .form-login {
        margin-top: 5rem;
        position: relative;
        margin-left: 7vw;
    }

    .form-login input {
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
            margin-left: 30%;
        }

        .form {
            background-color: red;
            padding-bottom: 5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-lg-5 form">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if(session('alert'))
            <div class="alert alert-danger" role="alert">
                {{ session('alert') }}
            </div>
            @endif
            <h1 class="text-center title">LOGIN</h1>
            <div class="form-login">
                <form action="postLogin" method="POST">
                    {{ csrf_field() }}
                    <label for="email" class="ml-2">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" id="email">
                    <label for="password" class="ml-2">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" id="password">
                    <p class="mt-2 ml-2 ">Don't Have Any Account ? <a href="/register">Register</a></p>
                    @if(session('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-3 ml-2  d-inline">Submit</button>
                    <a href="/" class=" btn btn-dark mt-3 ml-2">Home</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7  ">
        <img src="/img/3226801.jpg" alt="">
    </div>
</div>
@endsection