<?php

namespace BCC\ExtraToolsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * RatioUnitProviderPass registers the tagged ratio unit providers to the ratio unit provider.
 * 
 * @author Michel Salib <michelsalib@hotmail.com>
 */
class RatioUnitProviderPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {        
        if ($container->hasDefinition('bcc_extra_tools.ratio_unit_converter')) {
            $definition = $container->getDefinition('bcc_extra_tools.ratio_unit_converter');
            foreach ($container->findTaggedServiceIds('bcc_extra_tools.ratio_unit_provider') as $id => $attributes) {
                $definition->addMethodCall('registerRatioUnitProvider', array(new Reference($id)));
            }
        }
    }
}