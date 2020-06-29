@extends('dashboard.app')

@section('title','Edit Profile')


@section('style')
<style>
    .form-control {
        width: 80%;
    }

    @media screen and (min-width:768px) {
        .grid {
            display: grid;
            width: 100%;
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
            box-shadow: 5px 5px 26px rgb(162, 164, 168);
            box-sizing: border-box;
            border-radius: 10px;
            width: 65%;
            margin-top: 20px;
        }

        .part-2 {
            display: grid;
            grid-row-start: 1 /2;
            grid-column-start: 2/3;
            background-image: url('/img/form.jpg');
            background-size: 25rem;
            background-position: left 16vh;
            background-repeat: no-repeat;
            border-radius: 50px;
        }
    }

    @media screen and (max-width:767px) {

        .label-form {
            margin-left: center;
        }

        img {
            width: 0px;
        }
    }
</style>
@endsection

@section('content')
<div class="grid">
    <div class="part-1">
        <h1 class="title-page mt-4 ml-3">Edit Profile</h1>
        <hr class="hr-title   ml-3">
        <form action="/dashboard/admin/editProfile/{{ $data->id }}" class="ml-5" method="post" enctype="multipart/form-data">
            @method('patch')
            {{ csrf_field() }}
            <label for="name" class=" mt-2">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" value="{{ $data->name ? $data->name : old('name') }}" id="name">
            @error('name')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
            <label for="email" class=" mt-2 label-form">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="{{ $data->email ? $data->email : old('email') }}" id="email">
            @error('email')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
            <label for="password" class=" mt-2 label-form">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" id="password">
            @error('password')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
            <label for="image" class="  mt-2 label-form">Pilih Gambar</label>
            <div class="custom-file">
                <input type="file" name="profile_image" class="custom-file-input" id="image">
                <label class="custom-file-label form-control" for="iamge">Pilih Gambar</label>
            </div>
            @error('profile_image')
            <div class="ml-2 invalid-feedback d-block">
                {{ $message}}
            </div>
            @enderror
            <input type="submit" class="btn btn-primary mt-4" value="Submit">
        </form>
    </div>
    <div class="part-2">
    </div>
</div>
@endsection