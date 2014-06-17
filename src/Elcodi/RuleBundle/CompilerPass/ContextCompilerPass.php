<?php

/**
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\RuleBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ContextCompilerPass
 */
class ContextCompilerPass implements CompilerPassInterface
{
    /**
     * This compiler pass computes all services that want to configure the
     * RuleManager expression language instance, configuring injected
     * ExpressionLanguage
     *
     * @param ContainerBuilder $container Container
     */
    public function process(ContainerBuilder $container)
    {
        /**
         * We get our eventlistener
         */
        $definition = $container->getDefinition(
            'elcodi.core.rule.configuration.context_collection'
        );

        /**
         * We get all tagged services
         */
        $taggedServices = $container->findTaggedServiceIds(
            'elcodi.rule_context_configuration'
        );

        /**
         * We add every tagged Resolver into EventListener
         */
        foreach ($taggedServices as $id => $attributes) {

            $definition->addMethodCall(
                'addContextConfiguration',
                array(new Reference($id))
            );
        }
    }
}
