<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Transaksi {{ $transaction->nama }}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>

<body>
    <div class="brand">
        <h1>Ju-fud Store
        </h1>
        <p>Tempat beli makanan yang biasa aja</p>
    </div>
    <div class="title">
        <h1>Invoice</h1>
    </div>
    <div class="left">
        <h4 class="text-center">From: </h4>
        <p>Ju-fud Store <br>Jln sama aku nikah sama dia</p>
    </div>
    <div class="left">
        <h4>To:</h4>
        <p>Nama: {{ $transaction->nama }} <br> Email: {{ $transaction->email }} <br> No.telp {{ $transaction->telp}} <br> Alamaat {{ $transaction->alamat}} </p>
    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <th class="no">No</th>
                <th class="nama">Nama Barang</th>
                <th class="jumlah">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $foods as $food )
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $food->nama_barang }}</td>
                <td>{{ $food->jumlah_barang }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Jumlah</td>
                <td>Rp.{{ $transaction->jumlah }}</td>
            </tr>
        </tbody>
    </table>
    <div class="thanks">
        <h2>Terimakasih Telah berbelanja | Ju-fud </h5>
    </div>
</body>

</html>