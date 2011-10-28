<?php

namespace BCC\ExtraToolsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use BCC\ExtraToolsBundle\DependencyInjection\Compiler\RatioUnitProviderPass;
use BCC\ExtraToolsBundle\DependencyInjection\Compiler\UnitConverterPass;

class BCCExtraToolsBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new UnitConverterPass());
        $container->addCompilerPass(new RatioUnitProviderPass());
    }
}
