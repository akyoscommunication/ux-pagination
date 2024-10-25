<?php

namespace Akyos\UXPagination;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UXPagination extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }
}
