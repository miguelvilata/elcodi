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

namespace Elcodi\Component\Banner\Tests\Services;

use Elcodi\Component\Banner\Repository\BannerRepository;
use Elcodi\Component\Banner\Services\BannerManager;
use PHPUnit_Framework_TestCase;

class BannerManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BannerManager
     */
    protected $object;

    /**
     * @var BannerRepository
     */
    private $bannerRepository;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->bannerRepository = $this
            ->getMockBuilder('Elcodi\Component\Banner\Repository\BannerRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->object = new BannerManager($this->bannerRepository);
    }

    public function testGetBannersFromBannerZoneCode()
    {
        $this->object->getBannersFromBannerZoneCode(sha1(rand()));
    }

    public function testGetBannersFromBannerZone()
    {
        $this->object->getBannersFromBannerZone(
            $this->getMock('Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface')
        );
    }
}
