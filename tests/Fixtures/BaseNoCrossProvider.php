<?php

namespace Imoisey\Cross\Tests\Fixtures;

use Imoisey\Cross\Tests\BaseTestCase;
use Imoisey\Cross\Provider\ProviderInterface;

class BaseNoCrossProvider implements ProviderInterface
{
    private $helper;

    public function __construct(BaseTestCase $helper)
    {
        $this->helper = $helper;
    }

    public function getName()
    {
        return 'basenocross';
    }

    public function getCollections()
    {
        $items = [
            $this->helper->getItem("10:00", "11:30"),
            $this->helper->getItem("12:00", "13:00"),
            $this->helper->getItem("14:00", "15:00"),
        ];

        return [new BaseCollection($items)];
    }
}