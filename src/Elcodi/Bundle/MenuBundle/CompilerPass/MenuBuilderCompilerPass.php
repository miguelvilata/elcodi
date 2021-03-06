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

namespace Elcodi\Bundle\MenuBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use Elcodi\Component\Menu\ElcodiMenuStages;

/**
 * Class MenuBuilderCompilerPass.
 */
class MenuBuilderCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('elcodi.menu_builder')) {
            return null;
        }

        $definition = $container->findDefinition(
            'elcodi.menu_builder'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'menu.builder'
        );
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $tag) {
                $definition->addMethodCall(
                    'addMenuBuilder',
                    [
                        new Reference($id),
                        isset($tag['menus'])
                            ? $tag['menus']
                            : [],
                        isset($tag['stage'])
                            ? $tag['stage']
                            : ElcodiMenuStages::BEFORE_CACHE,
                        isset($tag['priority'])
                            ? $tag['priority']
                            : 0,
                    ]
                );
            }
        }
    }
}
