<?php

namespace App\Http\Livewire;

use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContentForm extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;
    public $tags;
    public $tag;
    public $file;
    public $type;

    protected function getRules()
    {
        if ($this->action == "update") {
            return [
                'data.title' => 'required|max:255',
                'data.contents' => 'required',
                'tag' => 'required'
            ];
        } else {
            return [
                'data.title' => 'required|max:255',
                'data.contents' => 'required',
                'file' => 'required|image',
                'tag' => 'required'
            ];
        }
    }

    public function mount()
    {
        $this->tags = Tag::get();

        $this->data['status'] = 'waiting';
        $this->data['type'] = $this->type;
        $this->data['thumbnail'] = '';
        $this->data['contents'] = '';

        if (!!$this->dataId) {

            $data = Content::find($this->dataId);
            $ta = $data->contentTags;
            $this->tag = [];
            for ($i = 0; $i < count($ta); $i++) {
                $this->tag[$i] = $ta[$i]->tag_id;
            }
            $this->data = [
                "title" => $data->title,
                "status" => $data->status,
                "contents" => $data->contents,
                "thumbnail" => $data->thumbnail,
                "note" => $data->note,
                "user_id" => $data->user_id,
                "type" => $data->type
            ];
        }
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->data['slug'] = Str::slug($this->data['title']);
        $this->data['user_id'] = Auth::id();
        $this->data['type'] = 1;

        if ($this->file->temporaryUrl() == null) {
            sleep(3);
            $this->create();
        }

        $this->data['thumbnail'] = $this->data['slug'] . '-' . $this->data['user_id'] . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/content', $this->data['thumbnail']);

        $content = Content::create($this->data);

        foreach ($this->tag as $tag) {
            ContentTag::create([
                'tag_id' => $tag,
                'content_id' => $content->id
            ]);
        }
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

        $this->data['slug'] = Str::slug($this->data['title']);

        if ($this->file) {
            $this->data['thumbnail'] = $this->data['slug'] . '-' . $this->data['user_id'] .  '.' .$this->file->getClientOriginalExtension();
            $this->file->storeAs('public/content', $this->data['thumbnail']);
        }

        Content::query()
            ->where('id', $this->dataId)
            ->update($this->data);

        ContentTag::whereContentId($this->dataId)->delete();

        foreach ($this->tag as $tag) {
            ContentTag::create([
                'tag_id' => $tag,
                'content_id' => $this->dataId
            ]);
        }

        $this->emit('swal:alert', [
            'icon' => 'success',
            'title' => 'Berhasil mengubah tulisan',
        ]);

        $this->emit('redirect');

    }

    public function render()
    {
        return view('livewire.content-form');
    }
}
