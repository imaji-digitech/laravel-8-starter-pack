<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component
{
    public $type;
    public $title;
    public $model;

    /**
     * Input constructor.
     * @param string $type
     * @param string $title
     * @param $model
     */
    public function __construct($type, $title, $model)
    {
        $this->type = $type;
        $this->title = $title;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.date');
    }
}
