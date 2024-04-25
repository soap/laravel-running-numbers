# Maintain document running number for Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soap/laravel-running-numbers.svg?style=flat-square)](https://packagist.org/packages/soap/laravel-running-numbers)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/soap/laravel-running-numbers/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/soap/laravel-running-numbers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/soap/laravel-running-numbers/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/soap/laravel-running-numbers/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/soap/laravel-running-numbers.svg?style=flat-square)](https://packagist.org/packages/soap/laravel-running-numbers)

The package provides a class to generate running number, keep track of them in database table.
One running number type can have many prefix to generate running number. Generated running numbers was not stored in database, just keep last number for each prefix.
You can reset it to specified value for each prefix.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-running-numbers.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-running-numbers)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require soap/laravel-running-numbers
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="running-numbers-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="running-numbers-config"
```

This is the contents of the published config file:

```php
return [
    'table_prefix' => '',
];
```

## Usage

```php
$runningNumber = new Soap\Laravel\RunningNumber\RunningNumber();
echo $runningNumber->echoPhrase('Hello, Soap\Laravel\RunningNumber!');
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

- [Prasit Gebsaap](https://github.com/soap)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
