<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CashBook;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    public function index($umkm)
    {
        $umkm= ProductType::find($umkm);
        return view('pages.cash-book.index',['cashBook'=>CashBook::class,'umkm'=>$umkm]);
    }

    public function create($umkm)
    {
        $umkm= ProductType::find($umkm);
        return view('pages.cash-book.create',compact('umkm'));
    }

    public function show($umkm,$id)
    {

    }

    public function edit($umkm,$id)
    {
        $umkm= ProductType::find($umkm);
        return view('pages.cash-book.edit',compact('id','umkm'));
    }
}
