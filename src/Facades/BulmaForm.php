<?php

namespace Isaac\BulmaForm\Facades;

use Illuminate\Support\Facades\Facade;

class BulmaForm extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bulmaform';
    }
}