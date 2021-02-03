<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class TagForm extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;

    protected function getRules()
    {
        return ['data.tag' => 'required|max:255'];
    }

    public function mount()
    {
        if ($this->dataId) {
            $data = Tag::find($this->dataId);
            $this->data = [
                "tag" => $data->tag,
            ];
        }
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        Tag::create($this->data);

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil menambahkan tag',
        ]);

        $this->emit('redirect');

    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate();

        Tag::query()
            ->where('id', $this->dataId)
            ->update($this->data);

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil mengubah tag',
        ]);

        $this->emit('redirect');

    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
