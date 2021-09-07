<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class DetailTransaction extends Component
{
    public $dataId;
    public $transaction;
    public function mount(){
        $this->transaction=Transaction::find($this->dataId);
    }
    public function render()
    {
        return view('livewire.detail-transaction');
    }
}
