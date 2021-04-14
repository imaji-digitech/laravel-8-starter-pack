<?php

namespace App\Http\Livewire;

use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormContent extends Component
{
    use WithFileUploads;

    public $action;

    public $content;
    public $contentId;
    public $contentTags;
    public $thumbnail;

    public $optionTags;
    public $optionStatus;

    public function mount()
    {
        if ($this->contentId != '') {
            //update state
            $c = Content::findOrFail($this->contentId);
            //all field
            $this->content = [
                'title' => $c->title,
                'content' => $c->content,
                'user_id' => $c->user_id,
                'status_id' => $c->status_id,
                'thumbnail' => $c->thumbnail,
                'created_at' => $c->created_at
            ];
            $this->contentTags = ContentTag::whereContentId($this->contentId)->pluck('tag_id')->toArray();
        } else {
            //create state
            //all field
            $this->content = [
                'title' => '',
                'content' => '',
                'user_id' => auth()->id(),
                'status_id' => 1,
                'thumbnail' => '',
                'created_at' => ''
            ];
            $this->contentTags = [];
        }

        $this->optionTags = eloquent_to_options(Tag::get(), 'id', 'title');
        $this->optionStatus = eloquent_to_options(Status::get(), 'id', 'title');

//        if you want create not from some table
//        $this->optionStatus=[
//            ['value'=>'waiting','title'=>'waiting'],
//            ['value'=>'accepted','title'=>'accepted'],
//            ['value'=>'decline','title'=>'decline'],
//        ];

    }

    public function render()
    {
        return view('livewire.form-content');
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $this->content['slug'] = Str::slug($this->content['title']);

        $image = $this->thumbnail;
        $filename = Str::slug($this->content['title'] . '-' . auth()->user()->name . '-' . rand(0, 1000)) . '.' . $image->getClientOriginalExtension();
        $image = Image::make($image)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->stream();
        Storage::disk('local')->put('public/contents/' . $filename, $image, 'public');

        $this->content['thumbnail'] = 'contents/' . $filename;
        $content = Content::create($this->content);
        foreach ($this->contentTags as $tag) {
            $this->contentTags['content_id'] = $content->id;
            $this->contentTags['tag_id'] = $tag;
            ContentTag::create($this->contentTags);
        }

        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data entered successfully',
            'timeout' => 3000,
            'icon' => 'success'
        ]);

        $this->emit('redirect', route('admin.content.index'));
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        $this->content['slug'] = Str::slug($this->content['title']);
        if ($this->thumbnail != null) {
            Storage::disk('local')->delete('public/' . $this->content['thumbnail']);
            $image = $this->thumbnail;
            $filename = Str::slug($this->content['title'] . '-' . auth()->user()->name . '-' . rand(0, 1000)) . '.' . $image->getClientOriginalExtension();
            $image = Image::make($image)->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->stream();
            Storage::disk('local')->put('public/contents/' . $filename, $image, 'public');
            $this->content['thumbnail'] = 'contents/' . $filename;
        }

        Content::find($this->contentId)->update($this->content);
        ContentTag::whereContentId($this->contentId)->delete();

        foreach ($this->contentTags as $tag) {
            $this->contentTags['content_id'] = $this->contentId;
            $this->contentTags['tag_id'] = $tag;
            ContentTag::create($this->contentTags);
        }

        $this->emit('swal:alert', [
            'type' => 'success',
            'title' => 'Data updated successfully',
            'timeout' => 3000,
            'icon' => 'success'
        ]);
        $this->emit('redirect', route('admin.content.index'));
    }

    protected function rules()
    {
        if ($this->action == 'create') {
            return [
                'content.status' => 'required',
                'content.title' => 'required',
                'content.content' => 'required',
                'content.created_at' => 'required',
                'thumbnail' => 'required|image',
                'contentTags'=>'required'
            ];
        } else {
            return [
                'content.status' => 'required',
                'content.title' => 'required',
                'content.content' => 'required',
                'content.created_at' => 'required',
                'contentTags'=>'required'
            ];
        }
    }


}
