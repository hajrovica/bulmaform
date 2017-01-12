<?php

namespace Isaac\BulmaForm;

use Mockery;
use AdamWathan\Form\FormBuilder;
use PHPUnit_Framework_TestCase;

class BasicFormBuilderTest extends PHPUnit_Framework_TestCase
{
    private $form;
    private $builder;

    public function setUp()
    {
        $this->builder = new FormBuilder;
        $this->form = new BasicFormBuilder($this->builder);
    }
    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    function render_text_group()
    {
        $expected = '<label class="label" for="name">Name</label><p class="control"><input type="text" name="name" class="input" id="name"></p>';
        $result = $this->form->text('Name', 'name')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_value()
    {
        $expected = '<label class="label" for="email">Email</label><p class="control"><input type="text" name="email" class="input" id="email" value="example@example.com"></p>';
        $result = $this->form->text('Email', 'email')->value('example@example.com')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Email is required.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="email">Email</label><p class="control is-danger"><input type="text" name="email" class="input" id="email"><span class="help">Email is required.</span></p>';
        $result = $this->form->text('Email', 'email')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_error_overrides_custom_help_block()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Email is required.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="email">Email</label><p class="control is-danger"><input type="text" name="email" class="input" id="email"><span class="help">Email is required.</span></p>';
        $result = $this->form->text('Email', 'email')->helpBlock('some custom text')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('example@example.com');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<label class="label" for="email">Email</label><p class="control"><input type="text" name="email" value="example@example.com" class="input" id="email"></p>';
        $result = $this->form->text('Email', 'email')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_old_input_and_default_value()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('example@example.com');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<label class="label" for="email">Email</label><p class="control"><input type="text" name="email" value="example@example.com" class="input" id="email"></p>';
        $result = $this->form->text('Email', 'email')->defaultValue('test@test.com')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_default_value()
    {
        $expected = '<label class="label" for="email">Email</label><p class="control"><input type="text" name="email" class="input" id="email" value="test@test.com"></p>';
        $result = $this->form->text('Email', 'email')->defaultValue('test@test.com')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_old_input_and_error()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('example@example.com');

        $this->builder->setOldInputProvider($oldInput);

        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Email is required.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="email">Email</label><p class="control is-danger"><input type="text" name="email" value="example@example.com" class="input" id="email"><span class="help">Email is required.</span></p>';
        $result = $this->form->text('Email', 'email')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_password_group()
    {
        $expected = '<label class="label" for="password">Password</label><p class="control"><input type="password" name="password" class="input" id="password"></p>';
        $result = $this->form->password('Password', 'password')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_password_group_doesnt_keep_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('password');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<label class="label" for="password">Password</label><p class="control"><input type="password" name="password" class="input" id="password"></p>';
        $result = $this->form->password('Password', 'password')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_password_group_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Password is required.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="password">Password</label><p class="control is-danger"><input type="password" name="password" class="input" id="password"><span class="help">Password is required.</span></p>';
        $result = $this->form->password('Password', 'password')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_button()
    {
        $expected = '<button type="button" class="button ">Click Me</button>';
        $result = $this->form->button('Click Me')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_button_with_name_and_alternate_styling()
    {
        $expected = '<button type="button" name="success" class="button is-primary">Click Me</button>';
        $result = $this->form->button('Click Me', 'success', 'is-primary')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_submit()
    {
        $expected = '<button type="submit" class="button ">Submit</button>';
        $result = $this->form->submit()->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_submit_with_alternate_styling()
    {
        $expected = '<button type="submit" class="button is-success">Submit</button>';
        $result = $this->form->submit('Submit', 'is-success')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_submit_with_value()
    {
        $expected = '<button type="submit" class="button is-success">Sign Up</button>';
        $result = $this->form->submit('Sign Up', 'is-success')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_select()
    {
        $expected = '<label class="label" for="color">Favorite Color</label><p class="control"><span class="select"><select name="color" id="color"><option value="1">Red</option><option value="2">Green</option><option value="3">Blue</option></select></span></p>';
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $result = $this->form->select('Favorite Color', 'color', $options)->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_select_with_selected()
    {
        $expected = '<label class="label" for="color">Favorite Color</label><p class="control"><span class="select"><select name="color" id="color"><option value="1">Red</option><option value="2">Green</option><option value="3" selected>Blue</option></select></span></p>';
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $result = $this->form->select('Favorite Color', 'color', $options)->select('3')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_select_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Color is required.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="color">Favorite Color</label><p class="control is-danger"><span class="select"><select name="color" id="color"><option value="1">Red</option><option value="2">Green</option><option value="3">Blue</option></select></span><span class="help">Color is required.</span></p>';
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $result = $this->form->select('Favorite Color', 'color', $options)->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function render_select_with_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('2');
        $this->builder->setOldInputProvider($oldInput);
        $expected = '<label class="label" for="color">Favorite Color</label><p class="control"><span class="select"><select name="color" id="color"><option value="1">Red</option><option value="2" selected>Green</option><option value="3">Blue</option></select></span></p>';
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $result = $this->form->select('Favorite Color', 'color', $options)->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_checkbox()
    {
        $expected = '<p class="control"><label class="checkbox"><input type="checkbox" name="terms" value="1">Agree to Terms</label></p>';
        $result = $this->form->checkbox('Agree to Terms', 'terms')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_checkbox_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Must agree to terms.');

        $this->builder->setErrorStore($errorStore);

        $expected = '<p class="is-danger control"><label class="checkbox"><input type="checkbox" name="terms" value="1">Agree to Terms</label><span class="help">Must agree to terms.</span></p>';
        $result = $this->form->checkbox('Agree to Terms', 'terms')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_checkbox_with_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('1');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<p class="control"><label class="checkbox"><input type="checkbox" name="terms" value="1" checked="checked">Agree to Terms</label></p>';
        $result = $this->form->checkbox('Agree to Terms', 'terms')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_checkbox_checked()
    {
        $expected = '<p class="control"><label class="checkbox"><input type="checkbox" name="terms" value="1" checked="checked">Agree to Terms</label></p>';
        $result = $this->form->checkbox('Agree to Terms', 'terms')->check()->render();
        $this->assertEquals($expected, $result);
    }

}
