<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view('pages.product-type.index',['productType'=>ProductType::class]);
    }
    public function create()
    {
        return view('pages.product-type.create');
    }

    public function edit($id)
    {
        return view('pages.product-type.edit',compact('id'));
    }
}
