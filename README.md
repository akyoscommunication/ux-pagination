# UX Pagination Bundle

Un bundle Symfony pour gérer facilement la pagination dans vos composants Twig.

## Fonctionnalités

- Pagination simple et intuitive
- Support de la pagination "Voir plus"
- Intégration avec UX Filters
- Personnalisation complète des templates et styles
- Support du tri des éléments
- Compatible avec les composants Live

## Installation

```bash
composer require akyos/ux-pagination
```

## Configuration

Le bundle ne nécessite pas de configuration supplémentaire. Il utilise les valeurs par défaut suivantes :

- Limite par page : 24 éléments
- Type de pagination : classique
- Tri par défaut : `createdAt` en ordre décroissant

## Utilisation

### Dans un Composant

```php
<?php

namespace App\Twig\Components\Product;

use Akyos\UXPagination\Trait\ComponentWithPaginationTrait;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class Index extends AbstractController
{
    use ComponentWithPaginationTrait;

    public function __construct()
    {
        $this->repository = Product::class;
        $this->setLimit(24);
    }
}
```

### Dans le Template

```twig
<div{{ attributes }}>
    {# Liste des éléments paginés #}
    {% for product in elements %}
        <div class="product">
            <h3>{{ product.name }}</h3>
            <p>{{ product.description|raw }}</p>
        </div>
    {% endfor %}

    {# Affichage de la pagination #}
    {{ pagination|raw }}
</div>
```

## Documentation

La documentation complète est disponible dans le dossier `docs/` :

- [Installation et Configuration](docs/installation.md)
- [Utilisation de Base](docs/usage.md)
- [Intégration avec UX Filters](docs/ux-filters-integration.md)
- [Personnalisation](docs/customization.md)

## Personnalisation

Le bundle offre plusieurs options de personnalisation :

- Surcharge des templates
- Personnalisation des styles CSS
- Configuration des classes CSS
- Personnalisation des messages
- Configuration du tri et de la limite

## Intégration avec UX Filters

Le bundle s'intègre parfaitement avec UX Filters pour une expérience de filtrage et de pagination fluide.

## Licence

Ce bundle est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
