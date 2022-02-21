<?php

namespace App\Http\Services;

class TestService implements \App\Http\Interfaces\TestServiceInterface
{

    public function test()
    {
        return 'Метод экземпляра класса, соответствующего интерфейсу';
    }

    public function get()
    {
        // TODO: Implement get() method.
    }
}
