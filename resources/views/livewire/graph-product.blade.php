<div>
    <div class="bg-white">
        <div class="row">
            <div class="col-lg-12 p-5 ">
                <x-chart-time-series type="line" :data="$transaction" height="100" title="transaksi"/>
            </div>
            <div class="col-lg-12 p-5 ">
                <x-chart-time-series type="line" :data="$payment" height="100" title="pembayaran"/>
            </div>
            <div class="col-lg-12 p-5 ">
                <x-chart-time-series type="line" :data="$credit" height="100" title="piutang"/>
            </div>
            <div class="col-lg-12 p-5 ">
                <x-chart-time-series type="line" :data="$return" height="100" title="pengembalian"/>
            </div>
        </div>
    </div>
</div>
