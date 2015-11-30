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

namespace Elcodi\Component\Attribute\Tests\UnitTest\Factory;

use Elcodi\Component\Attribute\Factory\AttributeFactory;
use Elcodi\Component\Core\Factory\DateTimeFactory;
use Elcodi\Component\Core\Tests\UnitTest\Factory\Abstracts\AbstractFactoryTest;

class AttributeFactoryTest extends AbstractFactoryTest
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new AttributeFactory();
        $this->object->setEntityNamespace('Elcodi\Component\Attribute\Entity\Attribute');
        $this->object->setDateTimeFactory(new DateTimeFactory());
    }

    public function testCreate()
    {
        $attribute = $this->object->create();

        $this->assertInstanceOf(
            'Elcodi\Component\Attribute\Entity\Attribute',
            $attribute
        );

        $this->assertTrue($attribute->isEnabled());
        $this->assertCount(0, $attribute->getValues());
        $this->assertNotNull($attribute->getCreatedAt());
    }
}
