# Utilisation de Base

## Navigation

- [Installation et Configuration](installation.md)
- [Utilisation de Base](usage.md)
- [Intégration avec UX Filters](ux-filters-integration.md)
- [Personnalisation](customization.md)

## Configuration du Composant

### Pagination Simple

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

### Template de Base

```twig
<div{{ attributes }}>
    {# Liste des éléments paginés #}
    {% for product in elements %}
        <div class="product">
            <div class="product__content">
                <h3 class="product__title">{{ product.name }}</h3>
                <p class="product__description">{{ product.description|raw }}</p>
                <p class="product__price">{{ product.price }}</p>
            </div>
        </div>
    {% endfor %}

    {# Affichage de la pagination #}
    {{ pagination|raw }}
</div>
```

## Options de Configuration

### Limite d'Éléments par Page

```php
public function __construct()
{
    $this->repository = Product::class;
    $this->setLimit(24); // Valeur par défaut du bundle
}
```

### Type de Pagination

Le bundle supporte deux types de pagination :

1. Pagination classique (par défaut) :
```php
public function __construct()
{
    $this->repository = Product::class;
    $this->setType('paginate'); // Type par défaut
}
```

2. Pagination "Voir plus" :
```php
public function __construct()
{
    $this->repository = Product::class;
    $this->setType('showMore');
}
```

### Tri des Éléments

```php
public function __construct()
{
    $this->repository = Product::class;
    $this->setDefaultSortField('createdAt');
    $this->setDefaultSortDirection('desc');
}
```

## Variables Disponibles dans le Template

Dans votre template Twig, vous avez accès aux variables suivantes :

- `elements` : Collection des éléments de la page courante
- `pagination` : Objet de pagination contenant :
  - `currentPage` : Page actuelle
  - `totalPages` : Nombre total de pages
  - `totalItems` : Nombre total d'éléments
  - `itemsPerPage` : Nombre d'éléments par page

## Exemple Complet

```php
<?php

namespace App\Twig\Components\Product;

use Akyos\UXPagination\Trait\ComponentWithPaginationTrait;
use App\Entity\Product;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class ProductList extends AbstractController
{
    use ComponentWithPaginationTrait;

    public function __construct()
    {
        $this->repository = Product::class;
        $this->setLimit(24);
        $this->setDefaultSortField('createdAt');
        $this->setDefaultSortDirection('desc');
    }

    public function getElements(): array
    {
        // Vous pouvez surcharger cette méthode pour personnaliser la requête
        return $this->getRepository()->findBy([], ['createdAt' => 'DESC']);
    }
}
```

```twig
<div{{ attributes }}>
    <div class="products-grid">
        {% for product in elements %}
            <div class="product-card">
                <h3>{{ product.name }}</h3>
                <p>{{ product.description|raw }}</p>
                <span class="price">{{ product.price }}€</span>
            </div>
        {% endfor %}
    </div>

    <div class="pagination-section">
        {{ pagination|raw }}
    </div>
</div>
``` 