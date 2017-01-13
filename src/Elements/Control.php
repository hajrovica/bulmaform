<?php

namespace Isaac\BulmaForm\Elements;

use AdamWathan\Form\Elements\Element;
use AdamWathan\Form\Elements\Label;

class Control extends Element
{
    protected $label;
    protected $control;
    protected $helpBlock;

    public function __construct(Label $label, Element $control)
    {
        $this->label = $label;
        $this->control = $control;
        $this->addClass('control');
    }

    public function render()
    {
        $html = $this->label;
        $html .= '<p';
        $html .= $this->renderAttributes();
        $html .= '>';
        $html .= $this->control;
        $html .= $this->renderHelpBlock();
        $html .= '</p>';

        return $html;
    }

    public function helpBlock($text)
    {
        if (isset($this->helpBlock)) {
            return;
        }
        $this->helpBlock = new Help($text);
        return $this;
    }

    protected function renderHelpBlock()
    {
        if ($this->helpBlock) {
            return $this->helpBlock->render();
        }

        return '';
    }

    public function control()
    {
        return $this->control;
    }

    public function label()
    {
        return $this->label;
    }

    public function __call($method, $parameters)
    {
        call_user_func_array([$this->control, $method], $parameters);
        return $this;
    }
}
