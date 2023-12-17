# Ping2.me PHP SDK

## Installation

```bash
composer require ping2me/php
```

## Usage

```php
use Ping2me\Php\Ping;

(new Ping('@username/channel'))->send('New user Bob registered!');
```
