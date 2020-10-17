<?php

namespace Dotim\CP\ViewComponents;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Input type
     *
     * @var string
     */
    public $type;

    /**
     * Input label
     *
     * @var string|null
     */
    public $label;

    /**
     * Input id
     *
     * @var string|null
     */
    public $id;

    /**
     * Input constructor.
     *
     * @param string  $type
     * @param string  $label
     * @param string  $id
     */
    public function __construct($type = 'text', $label = null, $id = null)
    {
        $this->type = $type;
        $this->label = $label;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('control-panel::components.input');
    }
}
