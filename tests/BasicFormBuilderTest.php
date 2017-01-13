<?php

namespace Isaac\BulmaForm;

use Mockery;
use stdClass;
use PHPUnit_Framework_TestCase;
use AdamWathan\Form\FormBuilder;

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

    /** @test */
    function render_radio()
    {
        $expected = '<p class="control"><label class="radio"><input type="radio" name="color" value="red">Red</label></p>';
        $result = $this->form->radio('Red', 'color', 'red')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_radio_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Sample error');

        $this->builder->setErrorStore($errorStore);

        $expected = '<p class="is-danger control"><label class="radio"><input type="radio" name="color" value="red">Red</label><span class="help">Sample error</span></p>';
        $result = $this->form->radio('Red', 'color', 'red')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_radio_with_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('red');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<p class="control"><label class="radio"><input type="radio" name="color" value="red" checked="checked">Red</label></p>';
        $result = $this->form->radio('Red', 'color', 'red')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_textarea()
    {
        $expected = '<label class="label" for="bio">Bio</label><p class="control"><textarea name="bio" rows="10" cols="50" class="textarea" id="bio"></textarea></p>';
        $result = $this->form->textarea('Bio', 'bio')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_textarea_with_rows()
    {
        $expected = '<label class="label" for="bio">Bio</label><p class="control"><textarea name="bio" rows="5" cols="50" class="textarea" id="bio"></textarea></p>';
        $result = $this->form->textarea('Bio', 'bio')->rows(5)->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_textarea_with_cols()
    {
        $expected = '<label class="label" for="bio">Bio</label><p class="control"><textarea name="bio" rows="10" cols="20" class="textarea" id="bio"></textarea></p>';
        $result = $this->form->textarea('Bio', 'bio')->cols(20)->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_textarea_with_old_input()
    {
        $oldInput = Mockery::mock('AdamWathan\Form\OldInput\OldInputInterface');
        $oldInput->shouldReceive('hasOldInput')->andReturn(true);
        $oldInput->shouldReceive('getOldInput')->andReturn('Sample bio');

        $this->builder->setOldInputProvider($oldInput);

        $expected = '<label class="label" for="bio">Bio</label><p class="control"><textarea name="bio" rows="10" cols="50" class="textarea" id="bio">Sample bio</textarea></p>';
        $result = $this->form->textarea('Bio', 'bio')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_textarea_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Sample error');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="bio">Bio</label><p class="control is-danger"><textarea name="bio" rows="10" cols="50" class="textarea" id="bio"></textarea><span class="help">Sample error</span></p>';
        $result = $this->form->textarea('Bio', 'bio')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_open()
    {
        $expected = '<form method="POST" action="">';
        $result = $this->form->open()->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_open_get()
    {
        $expected = '<form method="GET" action="">';
        $result = $this->form->open()->get()->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_open_custom_action()
    {
        $expected = '<form method="POST" action="/login">';
        $result = $this->form->open()->action('/login')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_close()
    {
        $expected = '</form>';
        $result = $this->form->close();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function csrf_token()
    {
        $this->form->setToken('1234');
        $expected = '<input type="hidden" name="_token" value="1234">';
        $result = $this->form->token();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_open_put()
    {
        $expected = '<form method="POST" action=""><input type="hidden" name="_method" value="PUT">';
        $result = $this->form->open()->put()->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function form_open_delete()
    {
        $expected = '<form method="POST" action=""><input type="hidden" name="_method" value="DELETE">';
        $result = $this->form->open()->delete()->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_date_group()
    {
        $expected = '<label class="label" for="birthday">Birthday</label><p class="control"><input type="date" name="birthday" class="input" id="birthday"></p>';
        $result = $this->form->date('Birthday', 'birthday')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_date_time_local_group()
    {
        $expected = '<label class="label" for="dob">Date & time of birth</label><p class="control"><input type="datetime-local" name="dob" class="input" id="dob"></p>';
        $result = $this->form->dateTimeLocal('Date & time of birth', 'dob')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_email_group()
    {
        $expected = '<label class="label" for="email">Email</label><p class="control"><input type="email" name="email" class="input" id="email"></p>';
        $result = $this->form->email('Email', 'email')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_file_group()
    {
        $expected = '<label class="label" for="file">File</label><p class="control"><input type="file" name="file" class="input" id="file"></p>';
        $result = $this->form->file('File', 'file')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_file_group_with_error()
    {
        $errorStore = Mockery::mock('AdamWathan\Form\ErrorStore\ErrorStoreInterface');
        $errorStore->shouldReceive('hasError')->andReturn(true);
        $errorStore->shouldReceive('getError')->andReturn('Sample error');

        $this->builder->setErrorStore($errorStore);

        $expected = '<label class="label" for="file">File</label><p class="control is-danger"><input type="file" name="file" class="input" id="file"><span class="help">Sample error</span></p>';
        $result = $this->form->file('File', 'file')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function can_add_class_to_underlying_control()
    {
        $expected = '<label class="label" for="color">Favorite Color</label><p class="control"><span class="select"><select name="color" id="color" class="my-class"><option value="1">Red</option><option value="2">Green</option><option value="3">Blue</option></select></span></p>';
        $options = ['1' => 'Red', '2' => 'Green', '3' => 'Blue'];
        $result = $this->form->select('Favorite Color', 'color', $options)->addClass('my-class')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function render_text_group_with_label_class()
    {
        $expected = '<label class="label required" for="email">Email</label><p class="control"><input type="text" name="email" class="input" id="email"></p>';
        $result = $this->form->text('Email', 'email')->labelClass('required')->render();
        $this->assertEquals($expected, $result);
    }

    /** @test */
    function bind_object()
    {
        $object = $this->getStubObject();
        $this->form->bind($object);
        $expected = '<label class="label" for="first_name">First Name</label><p class="control"><input type="text" name="first_name" value="John" class="input" id="first_name"></p>';
        $result = $this->form->text('First Name', 'first_name')->render();
        $this->assertEquals($expected, $result);
    }

    private function getStubObject()
    {
        $obj = new stdClass;
        $obj->email = 'johndoe@example.com';
        $obj->first_name = 'John';
        $obj->last_name = 'Doe';
        $obj->date_of_birth = new \DateTime('1985-05-06');
        $obj->gender = 'male';
        $obj->terms = 'agree';
        return $obj;
    }
}
