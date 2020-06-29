@extends('dashboard.app')

@section('title','Dashboard')

@section('style')
<link rel="stylesheet" href="/css/dashboard.css">
@endsection

@section('content')
<div class="container">
    <h1 class="title-page mt-4 ml-3">Daftar Makanan</h1>
    <hr class="hr-title  ml-3">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show  mt-4" role="alert">
        {{ session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <table class="table table-striped m-2">
        <thead class="thead-primary">
            <tr>
                <th scope="col">Nama Makanan</th>
                <th scope="col">Harga</th>
                <th scope="col">Category</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        <tbody>
            @foreach( $datas as $data)
            <tr>
                <th scope="col">{{$data->title}}</th>
                <th scope="col">{{$data->price}}</th>
                <th scope="col">{{$data->category}}</th>
                <th scope="col">
                    <form action="/dashboard/edit/{{ $data->id }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </th>
                <th scope="col">
                    <form action="/dashboard/delete/{{ $data->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
    {{ $datas->links() }}
</div>
@endsection