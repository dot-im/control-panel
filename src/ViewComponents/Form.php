<?php

namespace Dotim\CP\ViewComponents;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Forum method.
     *
     * @var string
     */
    public $method;

    /**
     * Forum action.
     *
     * @var string|null
     */
    public $action;

    /**
     * Forum id.
     *
     * @var string|null
     */
    public $id;

    /**
     * Input constructor.
     *
     * @param string  $method
     * @param string  $action
     * @param string  $id
     * @param string  $route
     */
    public function __construct($method = 'POST', $action = null, $id = null, $route = null)
    {
        $this->method = $method;
        $this->action = $route ? route($route) : $action;
        $this->id = $id ? $id : Str::random(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('control-panel::components.form');
    }
}
