<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTime extends Component
{
    public $title;
    public $model;
    public $time;

    /**
     * FormTextarea constructor.
     * @param $title
     * @param $model
     * @param $time
     */
    public function __construct($title, $model, $time)
    {
        $this->title = $title;
        $this->model = $model;
        $this->time = $time;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.form-time');
    }
}
