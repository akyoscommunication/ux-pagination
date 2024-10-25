<?php

namespace Akyos\UXPagination;

use Akyos\UXPagination\DependencyInjection\UXPaginationExtention;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
class UXPagination extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new UXPaginationExtention();
        }
        return $this->extension;
    }
}
