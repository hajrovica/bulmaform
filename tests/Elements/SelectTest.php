<?php

namespace Isaac\BulmaForm\Elements;

use AdamWathan\Form\FormBuilder;
use PHPUnit_Framework_TestCase;

class SelectTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->builder = new FormBuilder;
    }

    /** @test */
    function can_render_select_form_control()
    {
        $label = $this->builder->label('Color');
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $text = $this->builder->select('color', $options);
        $formGroup = new Select($label, $text);
        $expected = '<label>Color</label><p class="control"><span class="select"><select name="color"><option value="1">Red</option><option value="2">Green</option><option value="3">Blue</option></select></span></p>';
        $result = $formGroup->render();
        $this->assertEquals($expected, $result);
    }
}