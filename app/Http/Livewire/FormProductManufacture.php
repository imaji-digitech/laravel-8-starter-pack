<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductManufacture;
use Livewire\Component;

class FormProductManufacture extends Component
{
    public $dataId;
    public $data;

    protected function getRules()
    {
        return [
            'data.title'=>'required|max:255',
            'data.price'=>'required|numeric',
            'data.amount'=>'required|numeric',
            'data.amount_product'=>'required|numeric',
        ];
    }

    public function mount(){
        $this->data=[
            'title'=>'',
            'price'=>0,
            'amount'=>0,
            'amount_product'=>0,
            'product_id'=>$this->dataId
        ];
    }

    public function create(){
        $this->validate();
        $this->resetErrorBag();
        ProductManufacture::create($this->data);
        $this->data=[
            'title'=>'',
            'price'=>0,
            'amount'=>0,
            'amount_product'=>0,
            'product_id'=>$this->dataId
        ];
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
    }

    public function delete($id){
        ProductManufacture::find($id)->delete();
    }

    public function render()
    {
        $productManufacture=ProductManufacture::whereProductId($this->dataId)->get();
        $total=0;
        foreach ($productManufacture as $f){
            $total+=($f->price*$f->amount)/$f->amount_product;
        }
        Product::find($this->dataId)->update(['hpp'=>$total]);
        return view('livewire.form-product-manufacture',compact('productManufacture','total'));
    }

}
