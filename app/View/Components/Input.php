<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{

    public $type;
    public $title;
    public $model;
    public $accept;


    /**
     * Input constructor.
     * @param string $type
     * @param string $title
     * @param string $model
     * @param string|null $accept
     */
    public function __construct($type, $title, $model, $accept=null)
    {
        $this->type = $type;
        $this->title = $title;
        $this->model = $model;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        return view('components.form.input');
    }
}
