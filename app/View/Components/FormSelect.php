<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSelect extends Component
{
    public $selected;
    public $options;
    public $model;
    public $title;

    /**
     * FormSelect constructor.
     * @param $selected
     * @param $options
     * @param $model
     * @param $title
     */
    public function __construct($options, $selected, $title, $model)
    {
        $this->selected = $selected;
        $this->options = $options;
        $this->model = $model;
        $this->title = $title;
    }


    public function isSelected($option)
    {
        return $option == $this->selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.form-select');
    }
}
