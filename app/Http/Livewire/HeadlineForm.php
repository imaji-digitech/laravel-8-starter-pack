<?php

namespace App\Http\Livewire;

use App\Models\Headline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadlineForm extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;
    public $file;
    public $type;

    protected function getRules()
    {
        return [
            'data.title' => 'required|max:255',
            'data.slug' => 'required',
        ];
    }

    public function mount()
    {
        $this->data['thumbnail'] ='';
        if (!!$this->dataId) {
            $data = Headline::find($this->dataId);
            $this->data = [
                "title" => $data->title,
                "slug" => $data->slug,
                "thumbnail" => $data->thumbnail,
            ];
        }
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->data['thumbnail'] = Str::slug($this->data['title']) . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/headline', $this->data['thumbnail']);

        Headline::create($this->data);


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

        if ($this->file) {
            $this->data['thumbnail'] = Str::slug($this->data['title']) . '.' . $this->file->getClientOriginalExtension();
            $this->file->storeAs('public/headline', $this->data['thumbnail']);
        }

        Headline::query()
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
        return view('livewire.headline-form');
    }
}
