<?php

namespace Dotim\CP\ViewComponents;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * View data.
     *
     * @var array
     */
    private $data = [];

    /**
     * Input constructor.
     *
     * @param string  $label
     * @param string  $id
     */
    public function __construct($label = '', $id = '')
    {
        $this->data = [
            'label' => $label, 'id' => $id ? $id : Str::random(10)
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('control-panel::components.select', $this->data);
    }
}
