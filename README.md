# Contao Resource Insert-Tag
Provides the ability to output content from various external sources via an insert tag

### Install
```
composer require oveleon/contao-resource-insert-tag
```

### Usage (*Example using the Packagist API*)

**1. Add a new resource**

| Field | Value |
| ------------- | ------------- |
| Title | Packagist - Cookiebar |
| Alias / Constant | cookiebar |
| Source url | https://packagist.org/packages/oveleon/contao-cookiebar.json |
| Method | GET |
| Data-Type | JSON |

**2. Create new insert tags within the resource**

| Field | Value |
| ------------- | ------------- |
| Alias / Tag | downloads |
| Path* | [package][downloads][total] |

\* Using the [Symfony PropertyAccess Component](https://symfony.com/doc/current/components/property_access.html#usage)

**3. Use the Insert-Tag**

```html
{{cookiebar::downloads}}

// Output: 1676
```

### ToDo:

- Handle caching
