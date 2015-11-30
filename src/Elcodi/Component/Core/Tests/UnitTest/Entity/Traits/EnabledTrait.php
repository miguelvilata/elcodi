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

namespace Elcodi\Component\Core\Tests\UnitTest\Entity\Traits;

trait EnabledTrait
{
    public function testEnabled()
    {
        $enabled = (bool) rand(0, 1);

        $setterOutput = $this->object->setEnabled($enabled);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->isEnabled();
        $this->assertSame($enabled, $getterOutput);
    }

    public function testEnable()
    {
        $this->object->setEnabled(false);
        $this->assertFalse($this->object->isEnabled());

        $setterOutput = $this->object->enable();
        $this->assertInstanceOf(get_class($this->object), $setterOutput);
        $this->assertTrue($this->object->isEnabled());
    }

    public function testDisable()
    {
        $this->object->setEnabled(true);
        $this->assertTrue($this->object->isEnabled());

        $setterOutput = $this->object->disable();
        $this->assertInstanceOf(get_class($this->object), $setterOutput);
        $this->assertFalse($this->object->isEnabled());
    }
}
