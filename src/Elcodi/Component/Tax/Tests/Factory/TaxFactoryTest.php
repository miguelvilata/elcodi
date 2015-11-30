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

namespace Elcodi\Component\Tax\Tests\Factory;

use Elcodi\Component\Core\Factory\DateTimeFactory;
use Elcodi\Component\Core\Tests\Factory\Abstracts\AbstractFactoryTest;
use Elcodi\Component\Tax\Factory\TaxFactory;

class TaxFactoryTest extends AbstractFactoryTest
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TaxFactory();
        $this->object->setEntityNamespace('Elcodi\Component\Tax\Entity\Tax');
        $this->object->setDateTimeFactory(new DateTimeFactory());
    }

    public function testCreate()
    {
        $tax = $this->object->create();

        $this->assertInstanceOf(
            'Elcodi\Component\Tax\Entity\Tax',
            $tax
        );

        $this->assertFalse($tax->isEnabled());
        $this->assertSame(0, $tax->getValue());
        $this->assertEmpty($tax->getName());
        $this->assertEmpty($tax->getDescription());
    }
}
