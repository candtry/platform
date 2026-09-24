<?php

namespace Candtry\Candtry\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Candtry\Candtry\Candtry
 */
class Candtry extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Candtry\Candtry\Candtry::class;
    }
}
