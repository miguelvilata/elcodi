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

namespace Elcodi\Component\Attribute\Tests\UnitTest\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

use Elcodi\Component\Attribute\Entity\Attribute;
use Elcodi\Component\Core\Tests\UnitTest\Entity\Traits;

class AttributeTest extends PHPUnit_Framework_TestCase
{
    use Traits\IdentifiableTrait, Traits\DateTimeTrait, Traits\EnabledTrait;

    const VALUE_CLASS = 'Elcodi\Component\Attribute\Entity\Interfaces\ValueInterface';

    /**
     * @var Attribute
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Attribute();
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
        $name = sha1(rand());
        $this->object->setName($name);

        $this->assertSame($name, (string) $this->object);
    }

    public function testValues()
    {
        $e1 = $this->getMock(self::VALUE_CLASS);
        $e2 = $this->getMock(self::VALUE_CLASS);

        $collection = new ArrayCollection([
            $e1,
        ]);

        $setterOutput = $this->object->setValues($collection);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getValues();
        $this->assertInstanceOf('Doctrine\Common\Collections\Collection', $getterOutput);
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::VALUE_CLASS, $getterOutput);

        $adderOutput = $this->object->addValue($e2);
        $this->assertInstanceOf(get_class($this->object), $adderOutput);

        $getterOutput = $this->object->getValues();
        $this->assertCount(2, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::VALUE_CLASS, $getterOutput);

        $removerOutput = $this->object->removeValue($e2);
        $this->assertInstanceOf(get_class($this->object), $removerOutput);

        $getterOutput = $this->object->getValues();
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::VALUE_CLASS, $getterOutput);

        $this->assertSame($e1, $getterOutput[0]);
    }
}
