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

namespace Elcodi\Component\Core\Tests\UnitTest\Factory\Abstracts;

use PHPUnit_Framework_TestCase;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Core\Factory\DateTimeFactory;
use Elcodi\Component\Core\Tests\UnitTest\Factory\Traits;

class AbstractFactoryTest extends PHPUnit_Framework_TestCase
{
    use Traits\EntityNamespaceTrait;

    /**
     * @var AbstractFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = $this
            ->getMockBuilder('Elcodi\Component\Core\Factory\Abstracts\AbstractFactory')
            ->getMockForAbstractClass()
        ;
    }

    public function testSetDateTimeFactory()
    {
        $dateTimeFactory = $this->getMock('Elcodi\Component\Core\Factory\DateTimeFactory');
        $this->object->setDateTimeFactory($dateTimeFactory);
    }

    public function testNow()
    {
        $this->object->setDateTimeFactory(new DateTimeFactory());

        $this->assertInstanceOf('DateTime', $this->object->now());
    }
}
