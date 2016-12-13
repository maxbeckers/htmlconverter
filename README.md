# HtmlConverter PHP Class

This PHP class can convert html to plaintext and plaintext to html.

## Installation

You can just run composer require to add this package on your app.

```
  composer require maxbeckers/htmlconverter
```

## Examples

### Html to plaintext
```php
...
use MaxBeckers\HtmlConverter\HtmlConverter;
...

$html = '...some html stuff...';

$converter = new HtmlConverter();

$plaintext = $converter->htmlToPlain($html);

```

### Plaintext to Html
```php
...
use MaxBeckers\HtmlConverter\HtmlConverter;
...

$plaintext = '...some plaintext stuff...';

$converter = new HtmlConverter();

$html = $converter->plainToHtml($plaintext);

```