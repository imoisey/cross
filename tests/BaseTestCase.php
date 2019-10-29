<?php

namespace Imoisey\Cross\Tests;

use Imoisey\Cross\Collection\Collection;
use Imoisey\Cross\ItemInterface;
use Imoisey\Cross\Manager;
use Imoisey\Cross\Provider\ProviderInterface;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    const CLASS_ITEM = '\Imoisey\Cross\ItemInterface';
    const CLASS_COLLECTION = '\Imoisey\Cross\Collection\Collection';

    public function getItem($begin, $end)
    {
        $stub = $this->getMockForAbstractClass(self::CLASS_ITEM);

        $stub->method('getPeriod')
             ->will($this->returnValue($this->getDatePeriod($begin, $end)));

        return $stub;
    }

    protected function getDatePeriod($begin, $end)
    {
        $beginObj = \DateTime::createFromFormat("H:i", $begin);
        $endObj = \DateTime::createFromFormat("H:i", $end);

        return new \DatePeriod($beginObj, new \DateInterval("PT5M"), $endObj);
    }
}


class BaseCollection extends Collection
{
}

class BaseWithCrossProvider implements ProviderInterface
{
    private $helper;

    public function __construct(BaseTestCase $helper)
    {
        $this->helper = $helper;
    }

    public function getName()
    {
        return 'basewithcross';
    }

    public function getCollections()
    {
        $items = [
            $this->helper->getItem("10:00", "11:30"),
            $this->helper->getItem("11:10", "13:00"),
            $this->helper->getItem("12:00", "15:00"),
        ];

        return [new BaseCollection($items)];
    }
}

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

class BaseManager extends Manager
{
    public function getProviders()
    {
        return $this->providers;
    }
}
