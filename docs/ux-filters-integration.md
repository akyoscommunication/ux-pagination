# Intégration avec UX Filters

## Navigation

- [Installation et Configuration](installation.md)
- [Utilisation de Base](usage.md)
- [Intégration avec UX Filters](ux-filters-integration.md)
- [Personnalisation](customization.md)

## Configuration de Base

Pour utiliser UX Pagination avec UX Filters, vous devez utiliser les deux traits dans votre composant Live :

```php
<?php

namespace App\Twig\Components\Product;

use Akyos\UXFilters\Class\Text;
use Akyos\UXFilters\Class\Select;
use Akyos\UXFilters\Class\Date;
use Akyos\UXFilters\Trait\ComponentWithFilterTrait;
use Akyos\UXPagination\Trait\ComponentWithPaginationTrait;
use App\Entity\Product;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class ProductList extends AbstractController
{
    use ComponentWithFilterTrait;
    use ComponentWithPaginationTrait;

    public function __construct()
    {
        $this->repository = Product::class;
        $this->setLimit(12);
    }

    protected function setFilters(): iterable
    {
        // Filtre de recherche textuelle
        yield (new Text('search', 'Recherche'))->setSearchType('like')->setParams([
            'entity.name',
            'entity.description',
        ]);

        // Filtre par catégorie
        yield (new Select('category', 'Catégorie'))
            ->setChoices($this->getCategories())
            ->setSearchType('exact')
            ->setParams(['entity.category']);

        // Filtre par date de création
        yield (new Date('createdAt', 'Date de création'))
            ->setSearchType('between')
            ->setParams(['entity.createdAt']);
    }
}
```

## Template avec Filtres et Pagination

```twig
<div{{ attributes }}>
    {# Section de filtres #}
    <div class="filters-section">
        {{ form(formFilters) }}
    </div>

    {# Liste des produits #}
    <div class="products-grid">
        {% for product in elements %}
            <div class="product-card">
                <h3>{{ product.name }}</h3>
                <p>{{ product.description|raw }}</p>
                <span class="price">{{ product.price }}€</span>
                <span class="category">{{ product.category }}</span>
            </div>
        {% endfor %}
    </div>

    {# Pagination #}
    <div class="pagination-section">
        {{ pagination|raw }}
    </div>
</div>
```

## Exemples d'Utilisation

### Recherche avec Pagination

```php
protected function setFilters(): iterable
{
    yield (new Text('search', 'Recherche'))->setSearchType('like')->setParams([
        'entity.name',
        'entity.description',
    ]);
}
```

### Filtres Multiples avec Pagination

```php
protected function setFilters(): iterable
{
    // Filtre de recherche
    yield (new Text('search', 'Recherche'))->setSearchType('like')->setParams([
        'entity.name',
        'entity.description',
    ]);

    // Filtre par catégorie
    yield (new Select('category', 'Catégorie'))
        ->setChoices($this->getCategories())
        ->setSearchType('exact')
        ->setParams(['entity.category']);

    // Filtre par prix
    yield (new Number('price', 'Prix'))
        ->setSearchType('between')
        ->setParams(['entity.price']);

    // Filtre par date
    yield (new Date('createdAt', 'Date de création'))
        ->setSearchType('between')
        ->setParams(['entity.createdAt']);
}
```

### Filtres Avancés avec Pagination

```php
protected function setFilters(): iterable
{
    // Filtre de recherche avec plusieurs champs
    yield (new Text('search', 'Recherche'))->setSearchType('like')->setParams([
        'entity.name',
        'entity.description',
        'entity.sku',
        'entity.brand',
    ]);

    // Filtre par catégorie avec sous-catégories
    yield (new Select('category', 'Catégorie'))
        ->setChoices($this->getCategories())
        ->setSearchType('exact')
        ->setParams(['entity.category'])
        ->setMultiple(true);

    // Filtre par disponibilité
    yield (new Boolean('available', 'Disponible'))
        ->setSearchType('exact')
        ->setParams(['entity.available']);

    // Filtre par date avec format personnalisé
    yield (new Date('createdAt', 'Date de création'))
        ->setSearchType('between')
        ->setParams(['entity.createdAt'])
        ->setFormat('d/m/Y');
}
``` 