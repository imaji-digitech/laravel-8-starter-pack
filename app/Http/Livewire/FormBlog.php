<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class FormBlog extends Component
{

    public $blog;
    public $blogTags;
    public $optionTags;
    public $optionStatus;

    public function mount()
    {
        $this->blog['contents'] = '<b>asdasd</b>';
        $this->blog['time'] = '21:00';
        $this->blog['timeaaa'] = date('Y-m-d').' - '.date('Y-m-d');
        $this->blog['status'] = 'waiting';
        $this->blogTags=[];
        $this->optionTags = eloquent_to_options(Tag::get(), 'id', 'title');
        $this->optionStatus=[
            ['value'=>'waiting','title'=>'waiting'],
            ['value'=>'accepted','title'=>'accepted'],
            ['value'=>'decline','title'=>'decline'],
        ];
    }

    public function render()
    {
        return view('livewire.form-blog');
    }

    public function create()
    {
        dd($this->blog);
    }

}
