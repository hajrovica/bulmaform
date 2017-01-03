<?php

namespace Isaac\BulmaForm\Elements;

use PHPUnit_Framework_TestCase;

class HelpTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function can_render_basic_help_block()
    {
        $helpBlock = new Help('Email is required.');

        $expected = '<span class="help">Email is required.</span>';
        $result = $helpBlock->render();
        $this->assertEquals($expected, $result);

        $helpBlock = new Help('First name is required.');

        $expected = '<span class="help">First name is required.</span>';
        $result = $helpBlock->render();
        $this->assertEquals($expected, $result);
    }
}