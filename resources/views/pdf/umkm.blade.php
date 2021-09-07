<!DOCTYPE html>
<html lang="en" style="margin: 0;padding: 0">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{public_path('vendor/bootstrap.min.css')}}">
    <title>Slip Gaji - Nama</title>
    <style>
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

    </style>
    {{--    body { margin: 0px; }--}}
</head>
<body style="padding: 0;margin: 0;">
<header style="width: 100%" id="header">
{{--    <img style="width: 100%" src="{{public_path('assets/kop-surat.png')}}" alt="">--}}
</header>
<footer id="footer">

</footer>

<main style="width:100%;padding: 170px 40px;" id="content">
    <center><h3>Report Usaha - {{$umkm->title}}</h3></center>
    <br>
    <table>
        <tr>
            <td>Nomor Usaha</td>
            <td>:</td>
            <td>IMSCPR001</td>
        </tr>
        <tr>
            <td>Jumlah Product</td>
            <td>:</td>
            <td style="width: 400px">{{ $umkm->products->count() }}</td>
        </tr>
        <tr>
            <td>Total Omzet Usaha</td>
            <td>:</td>
            <td>Rp {{number_format($turnover,0,'.','.')}}</td>
        </tr>
        <tr>
            <td style="width: 100px">Total hari beroperasi</td>
            <td>:</td>
            @php($created_at=new Carbon\Carbon($umkm->created_at))
            <td>{{$created_at->diff(Carbon\Carbon::now())->days }} Hari</td>
        </tr>

    </table>
    <br>
    <br>
    <table style="font-size: 8px;width: 100%;text-align: center" class="table">
        <tr style="font-weight: bold">
            <td>Produk</td>
            <td>Jumlah Transaksi</td>
            <td>Total Transaksi</td>
            <td>Jumlah Terbayar</td>
            <td>Total Terbayar</td>
            <td>Jumlah Piutang</td>
            <td>Total Piutang</td>
            <td>Jumlah Kembali</td>
            <td>Total Kembali</td>
        </tr>
        @foreach($umkm->products as $product)
            <tr>
                <td style="font-weight: bold">{{$product->title}}</td>
                <td>{{ $product->transactionDetails->sum('quantity') }}</td>
                <td>Rp {{ number_format($product->transactionDetails->sum('total'),0,'.','.') }}</td>
                <td>{{ $product->transactionPaymentDetails->sum('quantity') }}</td>
                <td>Rp {{ number_format($product->transactionPaymentDetails->sum('total'),0,'.','.') }}</td>
                <td>{{ $product->transactionCredits->sum('quantity') }}</td>
                <td>Rp {{ number_format($product->transactionCredits->sum('total'),0,'.','.') }}</td>
                <td>{{ $product->transactionReturnDetails->sum('quantity') }}</td>
                <td>Rp {{ number_format($product->transactionReturnDetails->sum('total'),0,'.','.') }}</td>
            </tr>
        @endforeach
    </table>
    <table style="width: 100%">
        <thead>
        <tr>
            <td style="width: 70%"></td>
            <td style="width: 30%">Jember, {{Carbon\Carbon::now()->format('d M Y')}}</td>
        </tr>
        </thead>
        <tr>
            <td></td>
            <td>Mengetahui</td>
        </tr>
        <tr>
            <td></td>
            <td><br><br><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td>Sociopreneur Community</td>
        </tr>
    </table>

</main>


</body>
</html>
