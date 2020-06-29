@extends('dashboard.app')

@section('title','Transaksi Berhasil')

@section('content')
<h1 class="title-page mt-4 ml-3">Transaksi Berhasil</h1>
<hr class="hr-title  ml-3">
@if(session('success'))
<div class="alert alert-success alert-dismissible  ml-3 w-50 fade show" role="alert">
    {{ session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if( $transactions->count() == 0 )
<div class="container">
    <div class="d-flex justify-content-center">
        <img src="/img/asuna-angry.jpg" class="mt-5" style=" width: 15rem;" alt="">
    </div>
    <div class="alert mt-5 alert-warning text-center" role="alert">
        <h3>Tidak ada transaksi yang masuk!</h3>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="container table-responsive">
            <table class="table ">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Email</th>
                        <th scope="col">No.Telephone</th>
                        <th scope="col">Jumlah Biaya</th>
                        <th scope="col">Tanggal transaksi</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $trans )
                    <tr>
                        <th>{{ $trans->nama}}</th>
                        <td>{{ $trans->email}}</td>
                        <td>{{ $trans->telp}}</td>
                        <td>Rp.{{ $trans->jumlah}}</td>
                        <td>{{ $trans->created_at}}</td>
                        <td><a href="/dashboard/payment/{{ $trans->id }}" class="btn btn-primary">Details</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endif
@endsection()