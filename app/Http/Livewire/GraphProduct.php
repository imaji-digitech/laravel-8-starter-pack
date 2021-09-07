<?php

namespace App\Http\Livewire;


use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraphProduct extends Component
{
    public $dataId;
    public $product;
    public $payment;
    public $return;
    public $transaction;
    public $credit;
    public function mount(){
//        dd($this->dataId);

        $productReturn=[];
        $productCredit=[];
        $productPayment=[];
        $productTransaction=[];
        $label=[];
        foreach ($this->dataId as $id){
            $this->product=Product::find($id);
            array_push($productReturn,$this->product->join('transaction_return_details', 'transaction_return_details.product_id', '=', 'products.id')->where('products.id', '=', $id)->whereDate('transaction_return_details.created_at', '>', Carbon::now()->subDays(365))->groupby('year', 'month', 'products.id')->get(['products.id', DB::raw('MONTH(transaction_return_details.created_at) as month, YEAR(transaction_return_details.created_at) as year, SUM(transaction_return_details.total) as number ')]));
            array_push($productPayment,$this->product->join('transaction_payment_details', 'transaction_payment_details.product_id', '=', 'products.id')->where('products.id', '=', $id)->whereDate('transaction_payment_details.created_at', '>', Carbon::now()->subDays(365))->groupby('year', 'month', 'products.id')->get(['products.id', DB::raw('MONTH(transaction_payment_details.created_at) as month, YEAR(transaction_payment_details.created_at) as year, SUM(transaction_payment_details.total) as number ')]));
            array_push($productTransaction,$this->product->join('transaction_details', 'transaction_details.product_id', '=', 'products.id')->where('products.id', '=', $id)->whereDate('transaction_details.created_at', '>', Carbon::now()->subDays(365))->groupby('year', 'month', 'products.id')->get(['products.id', DB::raw('MONTH(transaction_details.created_at) as month, YEAR(transaction_details.created_at) as year, SUM(transaction_details.total) as number ')]));
            array_push($productCredit,$this->product->join('transaction_credits', 'transaction_credits.product_id', '=', 'products.id')->where('products.id', '=', $id)->whereDate('transaction_credits.created_at', '>', Carbon::now()->subDays(365))->groupby('year', 'month', 'products.id')->get(['products.id', DB::raw('MONTH(transaction_credits.created_at) as month, YEAR(transaction_credits.created_at) as year, SUM(transaction_credits.total) as number ')]));
            array_push($label,$this->product->title);
        }

        $this->payment = eloquent_to_multi_chart_time_series($productPayment, $label);
        $this->return = eloquent_to_multi_chart_time_series($productReturn, $label);
        $this->credit = eloquent_to_multi_chart_time_series($productCredit, $label);
        $this->transaction = eloquent_to_multi_chart_time_series($productTransaction, $label);
//        dd($this->credit);
//        $this->full=eloquent_to_multi_chart_time_series([$productTransaction,$productPayment,$productCredit,$productReturn],['Transaksi','Pembayaran','Piutang','Pengembalian']);
    }
    public function render()
    {
        return view('livewire.graph-product');
    }
}
