# Localizations package for Admin Kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibec-box/admin-kit-localizations.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-localizations)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ibec-box/admin-kit-localizations/run-tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/ibec-box/admin-kit-localizations/actions?query=workflow%3Arun-tests+branch%3A2.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibec-box/admin-kit-localizations/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/ibec-box/admin-kit-localizations/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3A2.x)
[![Total Downloads](https://img.shields.io/packagist/dt/ibec-box/admin-kit-localizations.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-localizations)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require ibecsystems/admin-kit-localizations
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="admin-kit-localizations-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="admin-kit-localizations-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="admin-kit-localizations-views"
```

## Usage

```php
$localizations = new AdminKit\Localizations();
echo $localizations->echoPhrase('Hello, AdminKit!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Anastas Mironov](https://github.com/ast21)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
