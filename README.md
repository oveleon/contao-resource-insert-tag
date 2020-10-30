# Contao Resource Insert-Tag
Provides the ability to output content from various external sources via an insert tag

> ⚠ This bundle is in development and not yet finished.

### Install
```
composer require oveleon/contao-resource-insert-tag
```

### Usage

- Add a new resource e.g. cookiebar -> https://packagist.org/packages/oveleon/contao-cookiebar.json
- Add new tags that refer to a key within the resource and specify the path e.g. downloads -> [package][downloads][total]
- Use the Insert-Tag (Example output: 1676)
