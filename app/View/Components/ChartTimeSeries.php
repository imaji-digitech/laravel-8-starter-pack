<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChartTimeSeries extends Component
{
    public $type;
    public $title;
    public $datas;
    public $height;

    public function __construct($type,$data,$height,$title)
    {
        $this->type=$type;
        $this->datas=$data;
        $this->height=$height;
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.chart.chart-time-series');
    }
}
