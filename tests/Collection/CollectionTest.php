<?php

namespace Imoisey\Cross\Tests\Collection;

use Imoisey\Cross\Tests\BaseCollection;
use Imoisey\Cross\Tests\BaseTestCase;

class CollectionTest extends BaseTestCase
{
    protected $collection;

    public function setUp()
    {
        $this->collection = new BaseCollection();
    }

    public function testAddToCollection()
    {
        $item = $this->getItem('10:00', '11:30');

        $this->collection->add($item);
        $this->assertContains($item, $this->collection->all(), 'ItemInterface не был добавлен.');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOutItemCollection()
    {
        $item = [];

        $this->collection = new BaseCollection();
        $this->collection->add($item);
    }

    public function testAddAllToCollection()
    {
        $items = [
            $this->getItem('10:00', '11:30'),
            $this->getItem('12:00', '13:30'),
        ];

        $this->collection = new BaseCollection();
        $this->collection->addAll($items);
        $this->assertContainsOnlyInstancesOf(self::CLASS_ITEM, $this->collection->all());
    }

    public function testVerifyIsCollisionExist()
    {
        $items = [
            $this->getItem('10:30', '11:00'),
            $this->getItem('11:00', '12:00'),
            $this->getItem('11:20', '12:00'),
        ];

        $this->collection->addAll($items);
        $this->assertTrue($this->collection->verify());
        $this->assertNotEmpty($this->collection->getCollision());
    }

    public function testVerify()
    {
        $items = [
            $this->getItem('10:30', '11:00'),
            $this->getItem('11:00', '12:00'),
            $this->getItem('13:20', '14:00'),
        ];

        $this->collection->addAll($items);
        $this->assertFalse($this->collection->verify());
        $this->assertEmpty($this->collection->getCollision());
    }
}
