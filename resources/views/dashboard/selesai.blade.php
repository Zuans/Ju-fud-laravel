@extends('dashboard.app')


@section('title','Pesanan Selesai')

@section('content')
<h1 class="title-page text-left mt-4 ml-3">Pesanan Selesai</h1>
<hr class="hr-title  ml-3">
<div class="container table-responsive">
    <table class="table mt-2">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $datas as $data )
            <tr>
                <td class="text-dark">{{ $loop->iteration }}</td>
                <td class="text-dark">{{ $data->nama }}</td>
                <td class="text-dark">Rp.{{ $data->jumlah }}</td>
                <td class="text-dark">{{ $data->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $datas->links() }}
    </div>
</div>
@endsection