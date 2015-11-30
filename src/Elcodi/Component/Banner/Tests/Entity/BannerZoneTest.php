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

use Elcodi\Component\Banner\Entity\BannerZone;
use Elcodi\Component\Core\Tests\Entity\Traits;

class BannerZoneTest extends PHPUnit_Framework_TestCase
{
    use Traits\IdentifiableTrait;

    const BANNER_CLASS = 'Elcodi\Component\Banner\Entity\Interfaces\BannerInterface';
    const LANGUAGE_CLASS = 'Elcodi\Component\Language\Entity\Interfaces\LanguageInterface';

    /**
     * @var BannerZone
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new BannerZone();
    }

    public function testName()
    {
        $name = sha1(rand());

        $setterOutput = $this->object->setName($name);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getName();
        $this->assertSame($name, $getterOutput);
    }

    public function testCode()
    {
        $code = sha1(rand());

        $setterOutput = $this->object->setCode($code);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getCode();
        $this->assertSame($code, $getterOutput);
    }

    public function testLanguage()
    {
        $language = $this->getMock(self::LANGUAGE_CLASS);

        $setterOutput = $this->object->setLanguage($language);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getLanguage();
        $this->assertSame($language, $getterOutput);
    }

    public function testBanner()
    {
        $e1 = $this->getMock(self::BANNER_CLASS);
        $e2 = $this->getMock(self::BANNER_CLASS);

        $collection = new ArrayCollection([
            $e1,
        ]);

        $setterOutput = $this->object->setBanners($collection);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getBanners();
        $this->assertInstanceOf('Doctrine\Common\Collections\Collection', $getterOutput);
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_CLASS, $getterOutput);

        $adderOutput = $this->object->addBanner($e2);
        $this->assertInstanceOf(get_class($this->object), $adderOutput);

        $getterOutput = $this->object->getBanners();
        $this->assertCount(2, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_CLASS, $getterOutput);

        $removerOutput = $this->object->removeBanner($e2);
        $this->assertInstanceOf(get_class($this->object), $removerOutput);

        $getterOutput = $this->object->getBanners();
        $this->assertCount(1, $getterOutput);
        $this->assertContainsOnlyInstancesOf(self::BANNER_CLASS, $getterOutput);

        $this->assertSame($e1, $getterOutput[0]);
    }

    public function testHeight()
    {
        $height = microtime(true);

        $setterOutput = $this->object->setHeight($height);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getHeight();
        $this->assertSame($height, $getterOutput);
    }

    public function testWidth()
    {
        $width = microtime(true);

        $setterOutput = $this->object->setWidth($width);
        $this->assertInstanceOf(get_class($this->object), $setterOutput);

        $getterOutput = $this->object->getWidth();
        $this->assertSame($width, $getterOutput);
    }

    public function testToString()
    {
        $name = sha1(rand());

        $this->object->setName($name);

        $this->assertSame(sprintf('%s - all languages', $name), (string) $this->object);
    }
}
