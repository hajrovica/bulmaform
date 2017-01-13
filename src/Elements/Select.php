<?php

namespace Isaac\BulmaForm\Elements;

class Select extends Control
{
    public function render()
    {
        $html = $this->label;
        $html .= '<p';
        $html .= $this->renderAttributes();
        $html .= '>';
        $html .= '<span class="select">';
        $html .= $this->control;
        $html .= '</span>';
        $html .= $this->renderHelpBlock();
        $html .= '</p>';

        return $html;
    }
}
