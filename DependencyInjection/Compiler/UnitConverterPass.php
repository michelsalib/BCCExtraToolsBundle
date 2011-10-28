<?php

namespace BCC\ExtraToolsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * UnitConverterPass registers the tagged unit converter with the chain unit converter.
 * 
 * @author Michel Salib <michelsalib@hotmail.com>
 */
class UnitConverterPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {        
        if ($container->hasDefinition('bcc_extra_tools.unit_converter')) {
            $definition = $container->getDefinition('bcc_extra_tools.unit_converter');
            foreach ($container->findTaggedServiceIds('bcc_extra_tools.unit_converter') as $id => $attributes) {
                $definition->addMethodCall('registerConverter', array(new Reference($id)));
            }
        }
    }
}