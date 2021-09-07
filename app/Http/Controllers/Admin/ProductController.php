<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product.index',['product'=>Product::class]);
    }
    public function create()
    {
        return view('pages.product.create');
    }

    public function edit($id)
    {
        return view('pages.product.edit',compact('id'));
    }
    public function show($id)
    {
        return view('pages.product.show',compact('id'));
    }
    public function manufacture($id){
        $product=Product::findOrFail($id);
        return view('pages.product.manufacture',compact('product'));
    }
    public function graph(Request $request){
        $validated = $request->validate([
            'productId'=>'required'
        ]);

        $data=$request->productId;
        return view('pages.product.graph',compact('data'));
    }
}
