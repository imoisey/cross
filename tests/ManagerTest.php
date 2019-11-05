<?php

namespace Imoisey\Cross\Tests;

use Imoisey\Cross\Tests\Fixtures\BaseManager;
use Imoisey\Cross\Tests\Fixtures\BaseNoCrossProvider;
use Imoisey\Cross\Tests\Fixtures\BaseWithCrossProvider;

class ManagerTest extends BaseTestCase
{
    protected $providerWithCross;
    protected $providerNoCross;

    public function setUp()
    {
        $this->providerWithCross = new BaseWithCrossProvider($this);
        $this->providerNoCross = new BaseNoCrossProvider($this);
    }

    public function testContstuct()
    {
        $manager = new BaseManager($this->providerWithCross);
        $this->assertContains($this->providerWithCross, $manager->getProviders());

        return $manager;
    }

    /**
     * @depends testContstuct
     */
    public function testAddToProvider($manager)
    {
        $manager->addProvider($this->providerNoCross);
        $this->assertContains($this->providerNoCross, $manager->getProviders());

        return $manager;
    }

    /**
     * @depends testAddToProvider
     */
    public function testVerifyWithCross($manager)
    {
        $this->assertTrue($manager->verify());
        $this->assertNotEmpty($manager->getCollision());
        $this->assertEquals($manager->getCollision(), $manager->getCollision($this->providerNoCross->getName()));
        $this->assertNotEmpty($manager->getCollision($this->providerWithCross->getName()));
    }

    public function testVerifyNoCross()
    {
        $manager = new BaseManager($this->providerNoCross);

        $this->assertFalse($manager->verify());
        $this->assertEmpty($manager->getCollision());
        $this->assertEmpty($manager->getCollision($this->providerNoCross->getName()));
    }
}
