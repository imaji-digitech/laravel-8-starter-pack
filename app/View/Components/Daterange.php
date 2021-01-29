<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Daterange extends Component
{

    public $title;
    public $model;

    /**
     * Input constructor.
     * @param string $title
     * @param $model
     */
    public function __construct($title, $model)
    {
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
        return view('components.form.daterange');
    }
}
