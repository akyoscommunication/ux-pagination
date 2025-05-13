# Personnalisation

## Navigation

- [Installation et Configuration](installation.md)
- [Utilisation de Base](usage.md)
- [Intégration avec UX Filters](ux-filters-integration.md)
- [Personnalisation](customization.md)

## Personnalisation du Template de Pagination

Vous pouvez personnaliser l'apparence de la pagination en surchargeant le template par défaut :

```twig
{# templates/bundles/UXPaginationBundle/pagination.html.twig #}
<nav class="pagination">
    {% if pagination.totalPages > 1 %}
        <ul class="pagination-list">
            {% if pagination.currentPage > 1 %}
                <li class="pagination-item">
                    <a href="{{ path(pagination.route, pagination.params|merge({'page': pagination.currentPage - 1})) }}" class="pagination-link">
                        Précédent
                    </a>
                </li>
            {% endif %}

            {% for i in pagination.pageRange %}
                <li class="pagination-item {% if i == pagination.currentPage %}active{% endif %}">
                    <a href="{{ path(pagination.route, pagination.params|merge({'page': i})) }}" class="pagination-link">
                        {{ i }}
                    </a>
                </li>
            {% endfor %}

            {% if pagination.currentPage < pagination.totalPages %}
                <li class="pagination-item">
                    <a href="{{ path(pagination.route, pagination.params|merge({'page': pagination.currentPage + 1})) }}" class="pagination-link">
                        Suivant
                    </a>
                </li>
            {% endif %}
        </ul>
    {% endif %}
</nav>
```

## Personnalisation du Style

### CSS de Base

```css
.pagination {
    display: flex;
    justify-content: center;
    margin: 2rem 0;
}

.pagination-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-item {
    margin: 0 0.25rem;
}

.pagination-link {
    display: block;
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
}

.pagination-item.active .pagination-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination-link:hover {
    background-color: #f8f9fa;
}
```

### Personnalisation Avancée

```css
/* Style moderne */
.pagination {
    --pagination-color: #007bff;
    --pagination-hover-color: #0056b3;
    --pagination-active-color: #fff;
    --pagination-border-radius: 4px;
    --pagination-padding: 0.5rem 1rem;
}

.pagination-list {
    gap: 0.5rem;
}

.pagination-link {
    position: relative;
    padding: var(--pagination-padding);
    border-radius: var(--pagination-border-radius);
    transition: all 0.3s ease;
}

.pagination-item.active .pagination-link {
    background-color: var(--pagination-color);
    color: var(--pagination-active-color);
}

.pagination-link:hover {
    background-color: var(--pagination-hover-color);
    color: var(--pagination-active-color);
}

/* Style avec icônes */
.pagination-link[rel="prev"]::before {
    content: "←";
    margin-right: 0.5rem;
}

.pagination-link[rel="next"]::after {
    content: "→";
    margin-left: 0.5rem;
}
```

## Personnalisation du Comportement

### Surcharge des Méthodes

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
    }

    // Surcharge de la méthode pour personnaliser la requête
    public function getElements(): array
    {
        return $this->getRepository()->findBy(
            ['active' => true],
            ['createdAt' => 'DESC'],
            $this->getLimit(),
            $this->getOffset()
        );
    }
}
```

### Personnalisation des Paramètres de Pagination

```php
public function __construct()
{
    $this->repository = Product::class;
    $this->setLimit(24);
    $this->setType('paginate'); // ou 'showMore'
    $this->setDefaultSortField('createdAt');
    $this->setDefaultSortDirection('desc');
}
```

## Personnalisation des Messages

Vous pouvez personnaliser les messages de la pagination en surchargeant le fichier de traduction :

```yaml
# translations/UXPaginationBundle.fr.yaml
pagination:
    previous: "Page précédente"
    next: "Page suivante"
    page: "Page %number%"
    of: "sur"
    items: "éléments"
    per_page: "par page"
``` 