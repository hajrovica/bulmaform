<?php

namespace Isaac\BulmaForm;

use AdamWathan\Form\FormBuilder;
use Isaac\BulmaForm\Elements\Control;
use Isaac\BulmaForm\Elements\GroupWrapper;
use Isaac\BulmaForm\Elements\Select;

class BasicFormBuilder
{
    protected $builder;

    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    protected function formGroup($label, $name, $control)
    {
        $label = $this->builder->label($label)->addClass('label')->forId($name);
        $control->id($name);

        $formGroup = new Control($label, $control);

        if ($this->builder->hasError($name)) {
            $formGroup->helpBlock($this->builder->getError($name));
            $formGroup->addClass('is-danger');
        }

        return $this->wrap($formGroup);
    }

    protected function selectFormGroup($label, $name, $control)
    {
        $label = $this->builder->label($label)->addClass('label')->forId($name);
        $control->id($name);

        $formGroup = new Select($label, $control);

        if ($this->builder->hasError($name)) {
            $formGroup->helpBlock($this->builder->getError($name));
            $formGroup->addClass('is-danger');
        }

        return $this->wrap($formGroup);
    }

    protected function wrap($group)
    {
        return new GroupWrapper($group);
    }

    public function text($label, $name, $value = null)
    {
        $control = $this->builder->text($name)->value($value)->addClass('input');
        return $this->formGroup($label, $name, $control);
    }

    public function password($label, $name)
    {
        $control = $this->builder->password($name)->addClass('input');
        return $this->formGroup($label, $name, $control);
    }

    public function button($value, $name = null, $type = "")
    {
        return $this->builder->button($value, $name)->addClass('button')->addClass($type);
    }

    public function submit($value = "Submit", $type = "")
    {
        return $this->builder->submit($value)->addClass('button')->addClass($type);
    }

    public function select($label, $name, $options = [])
    {
        $control = $this->builder->select($name, $options);
        return $this->selectFormGroup($label, $name, $control);
    }
}
