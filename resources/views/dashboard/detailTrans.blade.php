@extends('dashboard.app')

@section('title','Detail Transaksi')

@section('style')
<link rel="stylesheet" href="/css/detailTrans.css">
@endsection


@section('content')
<h1 class="title-page text-center mt-4 ml-3">Detail Pemesanan</h1>
<hr class="hr-title ml-auto ml-3">
<div class="container ">
    <div class="detail">
        <h1 class="text-white  title text-center">Detail Pemesan</h1>
        <hr class="mx-auto text-white w-25" style="border: 1px solid white;">
        <h4 class="text-white  title ml-4 mt-5">Nama Pemesan: {{ $transaction->nama }}</h4>
        <h4 class="text-white  title ml-4">Email Pemesan: {{ $transaction->email }}</h4>
        <h4 class="text-white  title ml-4">Alamat Pemesan: {{ $transaction->alamat }}</h4>
        <h4 class="text-white  title ml-4">No.telp Pemesan: {{ $transaction->telp }}</h4>
        <hr>
        <h1 class="text-white  mt-2 text-center title">Detail Barang</h1>
        <hr class="mx-auto text-white w-25" style="border: 1px solid white;">
        <div class="container table-responsive">
            <table class="table table-light mt-2">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food )
                    <tr>
                        <td class="text-dark">{{ $loop->iteration }}</td>
                        <td class="text-dark">{{ $food->nama_barang }}</td>
                        <td class="text-dark">{{ $food->jumlah_barang}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="/pdf/stream/{{ $transaction->id }}" class="mt-4 float-lg-right" method="post">
                {{ csrf_field() }}
                <button class="btn btn-primary  mt-2 ml-3">Lihat PDF</button>
            </form>
            <form action="/pdf/download/{{ $transaction->id }}" class="d-inline mt-4 float-lg-right " method="get">
                {{ csrf_field() }}
                <button class="btn btn-primary mt-2 ml-3">Download PDF</button>
            </form>
        </div>
        <div class="d-flex justify-content-center  mt-3">
            {{ $foods->links() }}
        </div>
    </div>
</div>
<div class="pb-5">
    <form action="/dashboard/payment/{{ $transaction->id }}" class="d-inline" method="post">
        @method('delete')
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success mt-2 ml-3">Pesanan Selesai</button>
    </form>
    <a href="/dashboard/payment" class="btn btn-dark  mt-2 ml-3">Back</a>
</div>
@endsection