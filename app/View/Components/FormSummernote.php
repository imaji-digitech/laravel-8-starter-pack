<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSummernote extends Component
{
    public $title;
    public $model;
    public $summernote;

    /**
     * FormSummernote constructor.
     * @param $title
     * @param $model
     * @param $summernote
     */
    public function __construct($title, $model, $summernote)
    {
        $this->title = $title;
        $this->model = $model;
        $this->summernote = $summernote;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.form-summernote');
    }
}
