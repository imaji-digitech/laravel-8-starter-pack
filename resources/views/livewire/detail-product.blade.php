<div>
    <h2 class="section-title">{{$product->title}}</h2>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Harga Produk</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->price,0,',','.')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>HPP Produk</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->hpp,0,',','.')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Rate Pengembalian</h4>
                    </div>
                    <div class="card-body">
                        {{intval($product->transactionReturnDetails->sum('quantity')/$product->transactionDetails->sum('quantity')*100)}}%
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Rate terjual</h4>
                    </div>
                    <div class="card-body">
                        {{intval($product->transactionPaymentDetails->sum('quantity')/$product->transactionDetails->sum('quantity')*100)}}%
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total transaksi</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->transactionDetails->sum('total'),0,',','.')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total terbayar</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->transactionPaymentDetails->sum('total'),0,',','.')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total piutang</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->transactionCredits->sum('total'),0,',','.')}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-scroll"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total balik</h4>
                    </div>
                    <div class="card-body">
                        Rp {{number_format($product->transactionReturnDetails->sum('total'),0,',','.')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="row">
            <div class="col-lg-6 p-5 ">
                <x-chart-time-series type="line" :data="$transaction" height="250" title="transaksi"/>
            </div>
            <div class="col-lg-6 p-5 ">
                <x-chart-time-series type="line" :data="$payment" height="250" title="pembayaran"/>
            </div>
            <div class="col-lg-6 p-5 ">
                <x-chart-time-series type="line" :data="$credit" height="250" title="piutang"/>
            </div>
            <div class="col-lg-6 p-5 ">
                <x-chart-time-series type="line" :data="$return" height="250" title="pengembalian"/>
            </div>
            <div class="col-lg-12 p-5">
                <x-chart-time-series type="line" :data="$full" height="100" title="full"/>
            </div>
        </div>
    </div>
</div>
