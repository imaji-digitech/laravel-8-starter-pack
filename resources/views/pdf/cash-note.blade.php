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
    <div style="">
        <center><b style="font-size: 24px">REKAP KAS BULANAN - {{strtoupper($umkm->title)}}</b></center>
        <br>
        <table style="font-size: 12px">
            <tr>
                <td>Nomor Usaha</td>
                <td>:</td>
                <td>IMSCPR001</td>
            </tr>
            <tr>
                <td>Kas awal bulan ini</td>
                <td>:</td>
                <td style="width: 400px">Rp {{number_format($c->balance,0,'.','.') }}</td>
            </tr>
            <tr>
                <td>Kas akhir bulan ini</td>
                <td>:</td>
                <td>
                    Rp {{number_format($c->balance+$cashBooks->sum('income')-$cashBooks->sum('outcome'),0,'.','.')}}</td>
            </tr>
        </table>
        <br>
        <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;" class="table">
            <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
                <th style="padding: 10px">Tanggal</th>
                <th style="padding: 10px">Kode</th>
                <th style="padding: 10px">Keterangan</th>
                <th style="padding: 10px">Masuk</th>
                <th style="padding: 10px">Keluar</th>
                <th style="padding: 10px">Saldo</th>
            </tr>
            <tbody>
            @foreach ($cashBooks as $cashBook)
                <tr style="font-size: 8px">
                    <td style="padding: 5px">{{ $cashBook->created_at->format('H:m d/M/Y') }}</td>
                    <td style="padding: 5px">{{ str_pad($cashBook->code_cash_book_id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td style="padding: 5px">{{ $cashBook->note }}</td>
                    <td style="padding: 5px 20px;">
                        {{ ($cashBook->income!=0?'Rp '.number_format($cashBook->income,0,'.','.'):'-') }}
                    </td>
                    <td style="padding: 5px 10px">
                        {{ ($cashBook->outcome!=0?'Rp '.number_format($cashBook->outcome,0,'.','.'):'-') }}
                    </td>
                    <td style="padding: 5px">
                        <span style="float: left">Rp</span>
                        <span style="float: right">
                        {{ number_format($c->balance=$c->balance+$cashBook->income-$cashBook->outcome,0,",",".") }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="page-break-before: always;"></div>
    <div>
        @foreach(\App\Models\CodeCashBook::get() as $pt)
            @if($cashBooks->where('code_cash_book_id',$pt->id)->count()==0 or $pt->id==999 or $pt->id==1)
                @continue
            @endif
            <br>
            <table style="margin-top:10px;width: 100%;text-align: center;border-bottom: 0.5px solid #000000;"
                   class="table">
                <tr style="font-size: 10px;font-weight: bold; background-color: #fdd100; ">
                    <th style="padding: 10px">Tanggal</th>
                    <th style="padding: 10px">Kode</th>
                    <th style="padding: 10px">Keterangan</th>
                    <th style="padding: 10px">Masuk</th>
                    <th style="padding: 10px">Keluar</th>
                </tr>
                <tbody>
                @php($count=0)
                @foreach ($cashBooks->where('code_cash_book_id',$pt->id) as $cashBook)
                    <tr style="font-size: 8px">
                        <td style="padding: 5px">{{ $cashBook->created_at->format('H:m d/M/Y') }}</td>
                        <td style="padding: 5px">{{ str_pad($cashBook->code_cash_book_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 5px">{{ $cashBook->note }}</td>
                        <td style="padding: 5px 20px">
                            @if($cashBook->income!=0)
                                <span style="float: left">Rp</span>
                                <span style="float: right">
                                    {{ number_format($cashBook->income,0,'.','.') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td style="padding: 5px 20px">
                            @if($cashBook->outcome!=0)
                                <span style="float: left">Rp</span>
                                <span style="float: right">
                                    {{ number_format($cashBook->outcome,0,'.','.') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @php($count=$count+$cashBook->income-$cashBook->outcome)
                @endforeach
                <tr style="font-size: 8px">
                    <td style="padding: 5px" colspan="3"><b>Total</b></td>
                    <td style="padding: 5px" colspan="2"><b>Rp {{ number_format($count,0,'.','.') }}</b></td>
                </tr>
                </tbody>
            </table>
        @endforeach
    </div>

    <div style="page-break-before: always;"></div>

    <div style="padding: 0 50px; ">
        <br>
        <div style="font-size: 8px;width: 100%;text-align: center" class="table">
            <center><b style="font-size: 24px">CV IMAJI SOCIOPRENEUR</b></center>
            <center><b style="font-size: 24px">LAPORAN LABA RUGI</b></center>
            <center>
                <b style="font-size: 12px">
                    Periode {{$c->created_at->format('d-m-Y')}} s.d {{$c1->created_at->format('d-m-Y')}}
                </b>
            </center>
        </div>
        <div style="padding: 0 50px">
            <table style="font-size: 8px;width: 100%;text-align: center" class="table">
                @foreach(\App\Models\CodeCashBook::get() as $pt)
                    @if($cashBooks->where('code_cash_book_id',$pt->id)->count()==0 or $pt->id==999 or $pt->id==1)
                        @continue
                    @endif
                    @php($cb=$cashBooks->where('code_cash_book_id',$pt->id))
                    <tr>
                        <td style="padding: 5px;text-align: left;width: 20px">{{ str_pad($pt->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 5px;text-align: left">{{ $pt->title }}</td>
                        <td style="padding: 5px;width: 30%">
                            <span style="float: left">Rp</span>
                            <span style="float: right">
                            {{ number_format($cb->sum('income')-$cb->sum('outcome'),0,'.','.') }}
                        </span>
                        </td>
                    </tr>
                @endforeach
                <tr style="font-size: 12px">
                    <td style="padding: 5px;text-align: left"><b>TOTAL</b></td>
                    <td style="padding: 5px"></td>
                    <td style="padding: 5px">
                        <span style="float: left">Rp</span>
                        <span style="float: right">
                        {{ number_format($cashBooks->sum('income')-$cashBooks->sum('outcome'),0,'.','.') }}
                    </span>
                </tr>
            </table>
        </div>

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
    </div>

</main>


</body>
</html>
