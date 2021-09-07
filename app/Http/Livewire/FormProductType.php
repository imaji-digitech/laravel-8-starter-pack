<?php

namespace App\Http\Livewire;

use App\Models\CashBook;
use App\Models\CashNote;
use App\Models\ProductType;
use App\Models\User;
use Livewire\Component;

class FormProductType extends Component
{
    public $data;
    public $dataId;
    public $action;
    public $optionUser;
    public function mount(){
        $this->data=['title'=>'','user_id'=>auth()->id()];
        $this->optionUser=eloquent_to_options(User::get(),'id','name');
        if ($this->dataId!=null){
            $data=ProductType::find($this->dataId);
            $this->data['title']=$data->title;
            $this->data['user_id']=$data->user_id;
        }
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $pt=ProductType::create($this->data);
        $cashbookId = CashBook::create([
            'income' => 0,
            'outcome' => 0,
            'code_cash_book_id' => 999,
            'note' => "Pembukaan Toko",
            'product_type_id' => $pt->id
        ]);
        $data = [
            'cash_book_id' => $cashbookId->id,
            'balance' => 0,
            'product_type_id' => $pt->id
        ];
        CashNote::create($data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.product-type.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        ProductType::find($this->dataId)->update($this->data);
        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.product-type.index'));
    }

    public function render()
    {
        return view('livewire.form-product-type');
    }

    protected function rules()
    {
        return [
            'data.title' => 'required|max:255',
        ];
    }
}
