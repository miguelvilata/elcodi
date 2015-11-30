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

use PHPUnit_Framework_TestCase;

use Elcodi\Component\Attribute\Entity\Value;
use Elcodi\Component\Core\Tests\UnitTest\Entity\Traits;

class ValueTest extends PHPUnit_Framework_TestCase
{
    use Traits\IdentifiableTrait;

    /**
     * @var Value
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Value();
    }

    public function testValue()
    {
        $value = sha1(rand());

        $setterOutput = $this->object->setValue($value);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getValue();
        $this->assertSame($value, $getterOutput);
    }

    public function testToString()
    {
        $value = sha1(rand());
        $this->object->setValue($value);

        $this->assertSame($value, (string) $this->object);
    }

    public function testGetAttribute()
    {
        $attribute = $this->getMock('Elcodi\Component\Attribute\Entity\Interfaces\AttributeInterface');

        $setterOutput = $this->object->setAttribute($attribute);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getAttribute();
        $this->assertSame($attribute, $getterOutput);
    }
}
