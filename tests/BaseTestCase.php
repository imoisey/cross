<?php

namespace Imoisey\Cross\Tests;

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
        $beginObj = \DateTime::createFromFormat('H:i', $begin);
        $endObj = \DateTime::createFromFormat('H:i', $end);

        return new \DatePeriod($beginObj, new \DateInterval('PT5M'), $endObj);
    }
}
