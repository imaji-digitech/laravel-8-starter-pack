<div>
    @if($transaction->payment_status_id==3)
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
                            Rp {{number_format($transaction->transactionDetails->sum('total'),0,',','.')}}
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
                            Rp {{number_format($transaction->join('transaction_payments','transactions.id','=','transaction_payments.transaction_id')->join('transaction_payment_details','transaction_payments.id','=','transaction_payment_details.transaction_payment_id')->where('transactions.id','=',$transaction->id)->groupBy('transactions.id')->get(['transactions.id',\Illuminate\Support\Facades\DB::raw('sum(transaction_payment_details.total) as value')])->sum('value'),0,',','.')}}
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
                            Rp {{number_format($transaction->transactionCredits->sum('total'),0,',','.')}}
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
                            Rp {{number_format($transaction->join('transaction_returns','transactions.id','=','transaction_returns.transaction_id')->join('transaction_return_details','transaction_returns.id','=','transaction_return_details.transaction_return_id')->where('transactions.id','=',$transaction->id)->groupBy('transactions.id')->get(['transactions.id',\Illuminate\Support\Facades\DB::raw('sum(transaction_return_details.total) as value')])->sum('value'),0,',','.')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Transaksi Barang</h4>
            </div>
            <div class="card-body">
                @foreach($transaction->transactionDetails as $td)
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border: none">
                        {{ $td->product->title }}
                        <span class=" badge-pill">{{ $td->quantity }}pcs - Rp {{ number_format($td->total/$td->quantity,0,',','.') }}/pcs </span>
                    </li>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Pembayaran Barang</h4>
            </div>
            <div class="card-body">
                @forelse($transaction->transactionPayments as $index=>$tp)
                    <div class="card">
                        <div class="card-header" style="display: block; max-height: none;line-height: 0">
                            <h4 style="display: block">Pembayaran Barang ke - {{$index+1}}</h4><br>
                            <p>Tanggal pembayaran : {{$tp->created_at->format('d-m-Y')}}</p>
                        </div>
                        @foreach($tp->transactionPaymentDetails as $tpd)

                            <div class="card-body">
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="border: none">
                                    {{ $tpd->product->title }}
                                    <span class=" badge-pill">{{ $tpd->quantity }}pcs </span>
                                </li>
                            </div>

                        @endforeach
                    </div>
                @empty
                    <h1>Tidak ada barang yang dibayar</h1>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Barang Piutang</h4>
            </div>
            <div class="card-body">
                @forelse($transaction->transactionCredits as $index=>$tc)
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        style="border: none">
                        {{ $tc->product->title }}
                        <span class=" badge-pill">{{ $tc->quantity }}pcs </span>
                    </li>
                @empty
                    <h1>Sudah tidak ada barang yang terhutang</h1>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Pengembalian Barang</h4>
            </div>
            <div class="card-body">
                @forelse($transaction->transactionReturns as $index=>$tr)
                    <div class="card">
                        <div class="card-header" style="display: block; max-height: none;line-height: 0">
                            <h4 style="display: block">Pengembalian Barang ke - {{$index+1}} @if($tr->created_at->format('Y m d')==\Carbon\Carbon::now()->format('Y m d'))<i class="fa fa-16px fa-undo text-danger float-right"></i>@endif<i class="mr-3 fa fa-16px fa-download text-blue-500 float-right"></i></h4>
                            <p>Tanggal pengembalian : {{$tr->created_at->format('d-m-Y')}}</p>

                        </div>
                        @foreach($tr->transactionReturnDetails as $trd)
                            <div class="card-body">
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    style="border: none">
                                    {{ $trd->product->title }}
                                    <span class=" badge-pill">{{ $trd->quantity }}pcs </span>
                                </li>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <h1>Tidak ada barang yang dikembalikan</h1>
                @endforelse
            </div>
        </div>

    @else
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-scroll"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total transaksi</h4>
                            <h4>Jenis pembayaran : {{ $transaction->paymentStatus->title }}</h4>
                        </div>
                        <div class="card-body">
                            Rp {{number_format($transaction->transactionDetails->sum('total'),0,',','.')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-header">
                <h4>Transaksi Barang</h4>
            </div>
            <div class="card-body">
                @foreach($transaction->transactionDetails as $td)
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="border: none">
                        {{ $td->product->title }}
                        <span class=" badge-pill">{{ $td->quantity }}pcs - Rp {{ number_format($td->total/$td->quantity,0,',','.') }}/pcs </span>
                    </li>
                @endforeach
            </div>
        </div>
    @endif
</div>
