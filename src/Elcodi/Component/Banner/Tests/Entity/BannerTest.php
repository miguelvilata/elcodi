<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2015 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Component\Banner\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

use Elcodi\Component\Banner\Entity\Banner;
use Elcodi\Component\Core\Tests\Entity\Traits;

class BannerTest extends PHPUnit_Framework_TestCase
{
    use Traits\IdentifiableTrait, Traits\DateTimeTrait, Traits\EnabledTrait;

    const BANNER_ZONE_CLASS = 'Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface';

    /**
     * @var Banner
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Banner();
    }

    public function testName()
    {
        $name = sha1(rand());

        $setterOutput = $this->object->setName($name);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getName();
        $this->assertSame($name, $getterOutput);
    }

    public function testToString()
    {
        $id = rand();
        $name = sha1(rand());

        $this->object->setId($id);
        $this->object->setName($name);

        $this->assertSame(sprintf('%s - %s', $id, $name), (string) $this->object);
    }

    public function testDescription()
    {
        $description = sha1(rand());

        $setterOutput = $this->object->setDescription($description);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getDescription();
        $this->assertSame($description, $getterOutput);
    }

    public function testUrl()
    {
        $url = 'http://www.example.com/';

        $setterOutput = $this->object->setName($url);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getName();
        $this->assertSame($url, $getterOutput);
    }

    public function testBannerZones()
    {
        $e1 = $this->getMock(self::BANNER_ZONE_CLASS);
        $e2 = $this->getMock(self::BANNER_ZONE_CLASS);

        $collection = new ArrayCollection([
            $e1,
        ]);

        $setterOutput = $this->object->setBannerZones($collection);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getBannerZones();
        $this->assertInstanceOf('Doctrine\Common\Collections\Collection', $getterOutput);
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_ZONE_CLASS, $getterOutput);

        $adderOutput = $this->object->addBannerZone($e2);
        $this->assertInstanceOf(get_class($this->object), $adderOutput);

        $getterOutput = $this->object->getBannerZones();
        $this->assertCount(2, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_ZONE_CLASS, $getterOutput);

        $removerOutput = $this->object->removeBannerZone($e2);
        $this->assertInstanceOf(get_class($this->object), $removerOutput);

        $getterOutput = $this->object->getBannerZones();
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_ZONE_CLASS, $getterOutput);

        $this->assertSame($e1, $getterOutput[0]);
    }
}
