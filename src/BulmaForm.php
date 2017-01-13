<?php

namespace Isaac\BulmaForm;

class BulmaForm
{
    protected $builder;
    protected $basicFormBuilder;

    public function __construct(BasicFormBuilder $basicFormBuilder)
    {
        $this->basicFormBuilder = $basicFormBuilder;
    }

    public function open()
    {
        $this->builder = $this->basicFormBuilder;
        return $this->builder->open();
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->builder, $method], $parameters);
    }
}
