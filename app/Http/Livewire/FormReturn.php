<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\TransactionCredit;
use App\Models\TransactionPayment;
use App\Models\TransactionPaymentDetail;
use App\Models\TransactionReturn;
use App\Models\TransactionReturnDetail;
use Livewire\Component;

class FormReturn extends Component
{
    public $creditTransaction;
    public $dataId;
    public $dataCredit;
    public $total;
    public function mount(){
        $this->dataCredit=TransactionCredit::whereTransactionId($this->dataId)->get();
        foreach ($this->dataCredit as $dc){
            $this->creditTransaction[$dc->id]=$dc->quantity;
        }
    }
    public function payment(){
        $status=true;
        $nullCheck=false;
        foreach ($this->dataCredit as $dc){
            if ($dc->quantity < $this->creditTransaction[$dc->id]){
                $status=false;
                $this->emit('swal:alert', [
                    'icon' => 'error',
                    'title' => "Jumlah ".$dc->product->title." tidak valid",
                ]);
                break;
            }
            if ($this->creditTransaction[$dc->id] > 0){
                $nullCheck=true;
            }
        }
        if (!$nullCheck){
            $this->emit('swal:alert', [
                'icon' => 'failed',
                'title' => "Pembayaran minimal membayar 1 barang",
            ]);
        }
        if ($status and $nullCheck){
            $transaction=TransactionReturn::create(['transaction_id'=>$this->dataId]);
            foreach ($this->dataCredit as $dc){
                if ($this->creditTransaction[$dc->id] !=0 ){
                    if ($dc->quantity-$this->creditTransaction[$dc->id] ==0 ){
                        TransactionCredit::find($dc->id)->delete();
                    }else{
                        TransactionCredit::find($dc->id)->update([
                            'quantity'=>$dc->quantity-$this->creditTransaction[$dc->id],
                            'total'=>$dc->total-($dc->total/$dc->quantity)*intval($this->creditTransaction[$dc->id])
//                                $dc->total-$this->total
                        ]);
                    }
                    TransactionReturnDetail::create([
                        'transaction_return_id'=>$transaction->id,
                        'product_id'=>$dc->product_id,
                        'quantity'=>$this->creditTransaction[$dc->id],
                        'total'=>($dc->total/$dc->quantity)*intval($this->creditTransaction[$dc->id])
                    ]);
                }
            }
            if (count($this->dataCredit=TransactionCredit::whereTransactionId($this->dataId)->get())==0){
                Transaction::find($this->dataId)->update(['status_id'=>3]);
                $url="admin.transaction.history";
            }else{
                $url="admin.transaction.active";
            }
            $this->emit('swal:alert', [
                'icon' => 'success',
                'title' => 'Berhasil menambahkan pembayaran',
            ]);

            $this->emit('redirect', route($url));
        }
    }
    public function render()
    {
        $this->total=0;
        foreach($this->dataCredit as $dc){
            $this->total+=($dc->total/$dc->quantity)*intval($this->creditTransaction[$dc->id]);
        }
        return view('livewire.form-return');
    }
}
