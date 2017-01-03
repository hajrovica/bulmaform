<?php

namespace Isaac\BulmaForm\Elements;

use AdamWathan\Form\Elements\Element;

class Help extends Element
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
        $this->addClass('help');
    }

    public function render()
    {
        $html = '<span';
        $html .= $this->renderAttributes();
        $html .= '>';
        $html .= $this->message;
        $html .= '</span>';

        return $html;
    }
}