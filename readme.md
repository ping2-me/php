# Ping2.me PHP SDK

## Installation

```bash
composer require ping2-me/php
```

## Usage

### Setup

```php
// Set up your endpoint once at the beginning of your application 
// before sending any messages.
Ping2me\Php\Ping::$endpoint = '@daudau/debug'
```
### Use class style
```php
use Ping2me\Php\Ping;

Ping::make()->send('New user Bob registered!');
```

### Use function style
```php
ping('New user Bob registered!');
```
