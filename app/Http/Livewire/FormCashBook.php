<?php

namespace App\Http\Livewire;

use App\Models\CashBook;
use App\Models\CashNote;
use App\Models\CodeCashBook;
use Livewire\Component;

class FormCashBook extends Component
{
    public $action;
    public $dataId;
    public $data;
    public $optionCode;
    public $book;
    public $umkm;

    public function mount()
    {
        $arr = array();
        foreach (CodeCashBook::get() as $index => $a) {
            if ($index == 0) {
                continue;
            }
            $arr[$index - 1]['value'] = $a->id;
            $arr[$index - 1]['title'] = str_pad($a->id, 3, '0', STR_PAD_LEFT) . " " . $a->title;
        }
        $this->optionCode = $arr;
        $this->data = [
            'code_cash_book_id' => 2,
            'note' => ' - ',
            'income' => 0,
            'outcome' => 0,
            'product_type_id' => $this->umkm
        ];
        if ($this->dataId != null) {
            $m = CashBook::find($this->dataId);
            $this->data = [
                'code_cash_book_id' => $m->code_cash_book_id,
                'note' => $m->note,
                'income' => $m->income,
                'outcome' => $m->outcome,
                'product_type_id' => $m->product_type_id
            ];
            $this->book = $this->data;
        }
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();

        CashBook::create($this->data);
        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan data kas',
        ]);
        $this->emit('redirect', route('admin.cash-book.index', $this->umkm));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        CashBook::find($this->dataId)->update($this->data);
        $cashNote = CashNote::whereProductTypeId($this->umkm)->get();
        foreach ($cashNote as $cn) {
            if ($this->dataId < $cn->cash_book_id) {
                CashNote::find($cn->id)->update([
                    'balance' => $cn->balance + $this->data['income'] - $this->data['outcome'] + $this->book['outcome'] - $this->book['income']
                ]);
            }
        }
        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan distribusi',
        ]);
        $this->emit('redirect', route('admin.cash-book.index', $this->umkm));
    }

    public function render()
    {
        return view('livewire.form-cash-book');
    }

    protected function getRules()
    {
        return [
            'data.code_cash_book_id' => 'required',
            'data.note' => 'required',
            'data.income' => 'required',
            'data.outcome' => 'required'
        ];
    }
}
