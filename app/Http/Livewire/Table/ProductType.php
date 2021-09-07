<?php

namespace App\Http\Livewire\Table;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductType extends Main
{
    public function exportPDFUMKM($id){
//        $finance = Finance::find($id);

    }
    public function exportCSVUMKM($id)
    {
        $umkm=\App\Models\ProductType::find($id);
        $created = new Carbon($umkm->created_at);
        $now = Carbon::now();
        $totalDay = $created->diff($now)->days ;
        $totalProduct=$umkm->products->count();
        $totalTurnover=0;
        $payment=[];
        $fileName = Str::slug("Rekap-keuangan") . ".csv";
        foreach ($umkm->products as $product){
            array_push($payment,$product->transactionPaymentDetails->sum('total'));
        }
        foreach ($payment as $t){
            $totalTurnover+=$t;
        }

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($totalDay,$totalProduct,$totalTurnover,$umkm) {
            $delimiter = ';';
            $file = fopen('php://output', 'w');
            fputcsv($file, [''],$delimiter);
            fputcsv($file, ['Total hari beroperasi',$totalDay." hari"],$delimiter);
            fputcsv($file, ['Total produk',$totalProduct],$delimiter);
            fputcsv($file, ['Total omzet',$totalTurnover],$delimiter);
            fputcsv($file, ['Produk UMKM'],$delimiter);
            fputcsv($file, [''],$delimiter);
            foreach ($umkm->products as $product){
                fputcsv($file, ['Nama produk',$product->title],$delimiter);
                fputcsv($file, ['Total transaksi',$product->transactionDetails->sum('total')],$delimiter);
                fputcsv($file, ['Total terbayar',$product->transactionPaymentDetails->sum('total')],$delimiter);
                fputcsv($file, ['Total piutang',$product->transactionCredits->sum('total')],$delimiter);
                fputcsv($file, ['Total kembali',$product->transactionReturnDetails->sum('total')],$delimiter);
                fputcsv($file, [''],$delimiter);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
