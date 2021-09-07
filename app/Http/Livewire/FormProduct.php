<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;

class FormProduct extends Component
{
    public $optionType;
    public $data;
    public $dataId;
    public $action;

    public function mount()
    {
        $this->optionType=eloquent_to_options(ProductType::get(),'id','title');
        $this->data=[
            'title'=>'',
            'code'=>'',
            'product_type_id'=>1,
            'price'=>0,
        ];
        if ($this->dataId!=null){
            $m=Product::find($this->dataId);
            $this->data=[
                'title'=>$m->title,
                'code'=>$m->code,
                'product_type_id'=>$m->product_type_id,
                'price'=>$m->price,
            ];
        }
    }

    protected function rules()
    {
        return [
            'data.title' => 'required|max:255',
            'data.code' => 'required|max:255',
            'data.product_type_id' => 'required|max:255',
            'data.price' => 'required|numeric',
        ];
    }
    public function create(){
        $this->validate();
        $this->resetErrorBag();
        Product::create($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.product.index'));
    }

    public function update(){
        $this->validate();
        $this->resetErrorBag();
        Product::find($this->dataId)->update($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.product.index'));
    }

    public function render()
    {

        return view('livewire.form-product');
    }
}
