<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Context extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'context';
    }
}