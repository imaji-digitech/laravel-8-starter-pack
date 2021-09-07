<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailProduct extends Component
{
    public $dataId;
    public $product;
    public $payment;
    public $return;
    public $transaction;
    public $credit;
    public $full;
    public $type;


    public function mount()
    {
        $this->type="Munculkan grafik";
        $this->product = Product::find($this->dataId);
        $productReturn = $this->product
            ->join('transaction_return_details', 'transaction_return_details.product_id', '=', 'products.id')
            ->where('products.id', '=', $this->dataId)
            ->whereDate('transaction_return_details.created_at', '>', Carbon::now()->subDays(365))
            ->groupby('year', 'month', 'products.id')
            ->get(['products.id', DB::raw('MONTH(transaction_return_details.created_at) as month, YEAR(transaction_return_details.created_at) as year, SUM(transaction_return_details.total) as number ')]);

        $productPayment = $this->product
            ->join('transaction_payment_details', 'transaction_payment_details.product_id', '=', 'products.id')
            ->where('products.id', '=', $this->dataId)
            ->whereDate('transaction_payment_details.created_at', '>', Carbon::now()->subDays(365))
            ->groupby('year', 'month', 'products.id')
            ->get(['products.id', DB::raw('MONTH(transaction_payment_details.created_at) as month, YEAR(transaction_payment_details.created_at) as year, SUM(transaction_payment_details.total) as number ')]);

        $productTransaction=$this->product
            ->join('transaction_details', 'transaction_details.product_id', '=', 'products.id')
            ->where('products.id', '=', $this->dataId)
            ->whereDate('transaction_details.created_at', '>', Carbon::now()->subDays(365))
            ->groupby('year', 'month', 'products.id')
            ->get(['products.id', DB::raw('MONTH(transaction_details.created_at) as month, YEAR(transaction_details.created_at) as year, SUM(transaction_details.total) as number ')]);

        $productCredit=$this->product
            ->join('transaction_credits', 'transaction_credits.product_id', '=', 'products.id')
            ->where('products.id', '=', $this->dataId)
            ->whereDate('transaction_credits.created_at', '>', Carbon::now()->subDays(365))
            ->groupby('year', 'month', 'products.id')
            ->get(['products.id', DB::raw('MONTH(transaction_credits.created_at) as month, YEAR(transaction_credits.created_at) as year, SUM(transaction_credits.total) as number ')]);

        $this->payment = eloquent_to_multi_chart_time_series([$productPayment], ['Pembayaran']);
        $this->return = eloquent_to_multi_chart_time_series([$productReturn], ['Pengembalian']);
        $this->credit = eloquent_to_multi_chart_time_series([$productCredit], ['Piutang']);
        $this->transaction = eloquent_to_multi_chart_time_series([$productTransaction], ['Transaction']);
        $this->full=eloquent_to_multi_chart_time_series([$productTransaction,$productPayment,$productCredit,$productReturn],['Transaksi','Pembayaran','Piutang','Pengembalian']);
    }

    public function render()
    {
        $t=$this->type;
        return view('livewire.detail-product',compact('t'));
    }
}
