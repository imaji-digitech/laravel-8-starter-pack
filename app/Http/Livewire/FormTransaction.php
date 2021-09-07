<?php

namespace App\Http\Livewire;

use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionCredit;
use App\Models\TransactionDetail;
use App\Models\TransactionPayment;
use App\Models\TransactionPaymentDetail;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class FormTransaction extends Component
{
    public $action;
    public $dataId;

    public $data;
    public $product;
    public $detailTransaction;
    public $detailTransactionDiscount;
    public $total;

    public $optionUser;
    public $optionProduct;
    public $listProduct;
    public $optionStatus;
    public $cart;

    public function getRules()
    {
        return [
            'data.user_id' => 'required|numeric',
            'data.status' => 'required',
        ];
    }

    public function mount()
    {
        $this->cart = [];
        $this->data = [
            'user_id' => auth()->id(),
            'payment_status_id' => '1',
            'created_at' => date("Y-m-d")
        ];
        $this->listProduct = Product::get();
        $this->product = [];
        $this->optionProduct = array();
        foreach ($this->listProduct as $index => $a) {
            $this->optionProduct[$index]['value'] = $a->id;
            $this->optionProduct[$index]['title'] = $a->code . ' - ' . $a->title;
        }
        $this->optionUser = eloquent_to_options(User::get(), 'id', 'name');
        $this->optionStatus = eloquent_to_options(PaymentStatus::get(), 'id', 'title');
        if ($this->dataId != null) {
            $dd = TransactionDetail::whereTransactionId($this->dataId);
            $this->product = $dd->pluck('product_id')->toArray();
            $data = $dd->pluck('amount')->toArray();
            for ($i = 0; $i < count($data); $i++) {
                $this->detailTransaction[$this->product[$i]] = $data[$i];
            }
            $data = TransactionDetail::find($this->dataId);
            $this->data = [
                'title' => $data->title,
                'created_at' => $data->created_at->format('Y-m-d'),
                'payment_status_id' => $data->payment_status_id,
                'user_id' => $data->user_id,
            ];
        }
    }

    public function create()
    {
        if ($this->data['payment_status_id'] == 1 or $this->data['payment_status_id'] == 2) {
            $this->data['status_id'] = 3;
            $url = "admin.transaction.history";
        } else {
            $this->data['status_id'] = 1;
            $url = "admin.transaction.active";
        }
        $this->data['no_invoice'] = str_replace('-', '', $this->data['created_at']) . sprintf("%03d", (count(Transaction::whereDate('created_at', Carbon::today())->get()) + 1));
        $d = Transaction::create($this->data);
        if ($this->data['payment_status_id'] == 1 or $this->data['payment_status_id'] == 2 ) {
            $payment=TransactionPayment::create(['transaction_id'=>$d->id]);
        }
        foreach ($this->product as $p) {
            if (isset($this->detailTransaction[$p]) and isset($this->detailTransactionDiscount[$p])) {
                TransactionDetail::create([
                    'transaction_id' => $d->id,
                    'product_id' => $p,
                    'quantity' => $this->detailTransaction[$p],
                    'discount' => $this->detailTransactionDiscount[$p],
                    'total' => $this->listProduct->find($p)->price * intval($this->detailTransaction[$p]) * (100 - intval($this->detailTransactionDiscount[$p])) / 100,
                ]);
                if ($this->data['payment_status_id'] == 3) {
                    TransactionCredit::create([
                        'transaction_id' => $d->id,
                        'product_id' => $p,
                        'quantity' => $this->detailTransaction[$p],
                        'total' => $this->listProduct->find($p)->price * intval($this->detailTransaction[$p]) * (100 - intval($this->detailTransactionDiscount[$p])) / 100,
                    ]);
                }else{
                    TransactionPaymentDetail::create([
                        'transaction_payment_id' => $payment->id,
                        'product_id' => $p,
                        'quantity' => $this->detailTransaction[$p],
                        'total' => $this->listProduct->find($p)->price * intval($this->detailTransaction[$p]) * (100 - intval($this->detailTransactionDiscount[$p])) / 100,
                    ]);
                }
            }
        }

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan distribusi',
        ]);

        $this->emit('redirect', route($url));
    }

    public function render()
    {
        $this->total = 0;
        foreach ($this->product as $p) {
            if (!isset($this->detailTransaction[$p])) {
                $this->detailTransactionDiscount[$p] = 0;
                $this->detailTransaction[$p] = 0;
            }
            $this->total += $this->listProduct->find($p)->price * intval($this->detailTransaction[$p]) * (100 - intval($this->detailTransactionDiscount[$p])) / 100;
        }
        return view('livewire.form-transaction');
    }
}
