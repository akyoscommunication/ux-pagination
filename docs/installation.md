# Installation et Configuration

## Navigation

- [Installation et Configuration](installation.md)
- [Utilisation de Base](usage.md)
- [Intégration avec UX Filters](ux-filters-integration.md)
- [Personnalisation](customization.md)

## Installation

```bash
composer require akyos/ux-pagination
```

## Configuration

### Configuration du Composant Live

Le bundle utilise une valeur par défaut de 24 éléments par page. Vous pouvez personnaliser cette valeur dans votre composant Live :

```php
<?php

namespace App\Twig\Components\Product;

use Akyos\UXPagination\Trait\ComponentWithPaginationTrait;
use App\Entity\Product;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class Index extends AbstractController
{
    use ComponentWithPaginationTrait;

    public function __construct()
    {
        $this->repository = Product::class;
        $this->setLimit(24); // Valeur par défaut du bundle
    }
}
```

## Vérification de l'Installation

Pour vérifier que l'installation est correcte, vous pouvez :

1. Vérifier que le bundle est listé dans `composer.json`
2. Tester un composant Live avec la pagination 