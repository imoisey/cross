<?php

namespace Imoisey\Cross\Tests\Fixtures;

use Imoisey\Cross\Manager;

class BaseManager extends Manager
{
    public function getProviders()
    {
        return $this->providers;
    }
}