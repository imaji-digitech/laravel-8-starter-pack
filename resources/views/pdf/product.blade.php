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
            left: 0;
            top: 0;
            right: 0;
            height: 150px;
            text-align: center;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            right: 0;
            height: 30px;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }
    </style>
    {{--    body { margin: 0px; }--}}
</head>
<body style="padding: 150px 40px 30px 40px;margin: 0;">
<header style="width: 100%" id="header">
    <img style="width: 100%" src="{{public_path('images/kop_atas.jpg')}}" alt="">
</header>
<footer id="footer">
    <img style="width: 100%" src="{{public_path('images/kop_bawah.jpg')}}" alt="">
</footer>

<main style="width:100%;" id="content">
    <center><b style="font-size: 24px">REPORT PRODUK - {{strtoupper($product->title)}}</b></center>
    <br>
    <table style="font-size: 12px">
        <tr>
            <td>Kode Produk</td>
            <td>:</td>
            <td>{{$product->code}}</td>
        </tr>
        <tr>
            <td>Stok Produk</td>
            <td>:</td>
            <td style="width: 400px">0</td>
        </tr>
        <tr>
            <td>Total Omzet produk</td>
            <td>:</td>
            <td>Rp {{number_format($product->transactionPaymentDetails->sum('total'),0,'.','.')}}</td>
        </tr>
        <tr>
            <td style="width: 100px">Produk dibuat pada</td>
            <td>:</td>
            <td>{{ $product->created_at }}</td>
        </tr>

    </table>
    <br>
    <b>DETAIL TRANSAKSI</b>
    <br>
    <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;" class="table">
        <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
            <td style="padding: 10px">Nama Customer</td>
            <td style="padding: 10px">No Invoice</td>
            <td style="padding: 10px">Jenis Pembayaran</td>
            <td style="padding: 10px">Jumlah Barang</td>
            <td style="padding: 10px">Total Transaksi</td>
        </tr>
        @foreach($product->transactionDetails as $td)
            <tr style="font-size: 8px">
                <td style="padding: 5px">{{ $td->transaction->user->name }}</td>
                <td style="padding: 5px">{{ $td->transaction->no_invoice }}</td>
                <td style="padding: 5px">{{ $td->transaction->paymentStatus->title }}</td>
                <td style="padding: 5px">{{ $td->quantity }}</td>
                <td style="padding: 5px 20px"><span style="float: left">Rp</span> <span
                        style="float: right">{{ number_format($td->total,0,'.','.') }}</span></td>
            </tr>
        @endforeach
    </table>
    <br>
    <b>TRANSAKSI BERHASIL</b>
    <br>
    <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;" class="table">
        <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
            <td style="padding: 10px">Nama Customer</td>
            <td style="padding: 10px">No Invoice</td>
            <td style="padding: 10px">Jenis Pembayaran</td>
            <td style="padding: 10px">Jumlah Barang</td>
            <td style="padding: 10px">Total Transaksi</td>
        </tr>
        @foreach($product->transactionPaymentDetails as $td)
            <tr style="font-size: 8px">
                <td style="padding: 5px">{{ $td->transactionPayment->transaction->user->name }}</td>
                <td style="padding: 5px">{{ $td->transactionPayment->transaction->no_invoice }}</td>
                <td style="padding: 5px">{{ $td->transactionPayment->transaction->paymentStatus->title }}</td>
                <td style="padding: 5px">{{ $td->quantity }}</td>
                <td style="padding: 5px 20px"><span style="float: left">Rp</span> <span
                        style="float: right">{{ number_format($td->total,0,'.','.') }}</span></td>
            </tr>
        @endforeach
    </table>
    <br>
    <b>PIUTANG SEKARANG</b>
    <br>
    <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;" class="table">
        <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
            <td style="padding: 10px">Nama Customer</td>
            <td style="padding: 10px">No Invoice</td>
            <td style="padding: 10px">Jumlah Barang</td>
            <td style="padding: 10px">Total Transaksi</td>
        </tr>
        @foreach($product->transactionCredits as $td)
            <tr style="font-size: 8px">
                <td style="padding: 5px">{{ $td->transaction->user->name }}</td>
                <td style="padding: 5px">{{ $td->transaction->no_invoice }}</td>
                <td style="padding: 5px">{{ $td->quantity }}</td>
                <td style="padding: 5px 20px"><span style="float: left">Rp</span> <span
                        style="float: right">{{ number_format($td->total,0,'.','.') }}</span></td>
            </tr>
        @endforeach
    </table>
    <br>
    <b>BARANG DIKEMBALIKAN</b>
    <br>
    <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;" class="table">
        <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
            <td style="padding: 10px">Nama Customer</td>
            <td style="padding: 10px">No Invoice</td>
            <td style="padding: 10px">Jumlah Barang</td>
            <td style="padding: 10px">Total Transaksi</td>
            <td style="padding: 10px">Keterangan</td>
        </tr>
        @foreach($product->transactionReturnDetails as $td)
            <tr style="font-size: 8px; border-bottom: #000000 1px !important;">
                <td style="padding: 5px">{{ $td->transactionReturn->transaction->user->name }}</td>
                <td style="padding: 5px">{{ $td->transactionReturn->transaction->no_invoice }}</td>
                <td style="padding: 5px">{{ $td->quantity }}</td>
                <td style="padding: 5px 20px"><span style="float: left">Rp</span> <span
                        style="float: right">{{ number_format($td->total,0,'.','.') }}</span></td>
                <td style="padding: 5px"></td>
            </tr>
        @endforeach
    </table>

    <table style="width: 100%;font-size: 12px">
        <tr>
            <td style="width: 70%"></td>
            <td style="width: 30%">Jember, {{Carbon\Carbon::now()->format('d M Y')}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Mengetahui</td>
        </tr>
        <tr>
            <td></td>
            <td><br><br></td>
        </tr>
        <tr>
            <td></td>
            <td>Sociopreneur Community</td>
        </tr>
    </table>
</main>
</body>
</html>
