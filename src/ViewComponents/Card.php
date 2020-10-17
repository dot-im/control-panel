<?php

namespace Dotim\CP\ViewComponents;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Card header
     *
     * @var string
     */
    public $header;

    /**
     * Card body
     *
     * @var string
     */
    public $body;

    /**
     * Card footer
     *
     * @var string
     */
    public $footer;

    /**
     * Card constructor.
     *
     * @param  string  $header
     * @param  string  $body
     * @param  string  $footer
     * @return void
     */
    public function __construct($header = null, $body = null, $footer = null)
    {
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('control-panel::components.card');
    }
}
