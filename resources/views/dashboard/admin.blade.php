@extends('dashboard.app')

@section('title','Admin')

@section('style')
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('content')
<div class="cont">
    <div class="part-1">
        <div class="container">
            <h1 class="title-page mt-1 ml-3">Info Kamu</h1>
            <hr class="hr-title  ml-3">
            @if(session('alert'))
            <div class="alert alert-danger alert-dismissible fade show" style="width: 100%;" role="alert">
                {{ session('alert') }}
                <button type="button" class="close text-right" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" style="width: 100%;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card ml-3" style="width:90%;">
                <div class=" card-body">
                    <img src="" alt="">
                    <img src="/storage/profile_image/{{ $data->profile_image }}" class="mx-auto d-block" alt="">
                    <p class="card-title text-white text-center mt-3">{{ $data->name }}</p>
                    <p class="card-title text-white text-center">{{ $data->email }} </p>
                    <p class="card-title text-white text-center">{{ $data->created_at }} </p>
                </div>
                <a href="/dashboard/admin/editProfile/{{ $data->id }}" class="btn btn-primary mt-5 btn-act mx-auto" style="width: 50%;">Edit Profile</a>
                <a href="/dashboard/admin/editPass/{{ $data->id }}" class="btn btn-danger mt-3 btn-act mx-auto" style="width: 50%;">Edit Password</a>
            </div>
        </div>
    </div>
    <div class="part-2">
    </div>
</div>
@endsection