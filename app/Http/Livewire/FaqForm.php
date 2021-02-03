<?php

namespace App\Http\Livewire;

use App\Models\Faq;
use App\Models\FaqTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FaqForm extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;

    protected function getRules()
    {
        if ($this->action == "update") {
            return [
                'data.question' => 'required|max:255',
                'data.answer' => 'required',
            ];
        } else {
            return [
                'data.question' => 'required|max:255',
                'data.answer' => 'required',
            ];
        }
    }

    public function mount()
    {
        if ($this->dataId) {
            $data = Faq::find($this->dataId);
            $this->data = [
                "question" => $data->question,
                "answer" => $data->answer,
            ];
        }
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        Faq::create($this->data);

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan tulisan',
        ]);

        $this->emit('redirect');

    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate();

        Faq::query()
            ->where('id', $this->dataId)
            ->update($this->data);


        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil mengubah tulisan',
        ]);

        $this->emit('redirect');

    }

    public function render()
    {
        return view('livewire.faq-form');
    }
}
