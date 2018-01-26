<?php

namespace App\Services;

class Test1Service implements TestInterface
{
    public function getName(): string
    {
        return 'David';
    }
}
