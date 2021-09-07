<?php


namespace App\Http\Livewire\Table;


class Product extends Main
{
    public $checked;

    public function mount()
    {
        $this->checked = [];
    }

    public function graph()
    {

    }

    public function exportPDF($id)
    {

    }
}
