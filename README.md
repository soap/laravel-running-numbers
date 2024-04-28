# Maintain document running number for Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soap/laravel-running-numbers.svg?style=flat-square)](https://packagist.org/packages/soap/laravel-running-numbers)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/soap/laravel-running-numbers/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/soap/laravel-running-numbers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/soap/laravel-running-numbers/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/soap/laravel-running-numbers/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/soap/laravel-running-numbers.svg?style=flat-square)](https://packagist.org/packages/soap/laravel-running-numbers)

The package provides a class to generate running number, keep track of them in database table.
One running number type can have many prefix to generate running number. Generated running numbers was not stored in database, just keep last number for each prefix.
You can reset it to specified value for each prefix. If specified type and prefix does not exists in the database, it will be create and assign number to 1.

## Support us


We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://mycoding.academy/about-us). We publish all received postcards on [our virtual postcard wall](https://mycoding.academy/open-source/postcards).

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
RunningNumber::generate('STUDENT_CODE', '672', 3);
// 673001
RunningNumber::generate('STUDENT_CODE', '672', 3);
// 673002

// Reset specified type and prefix to some value
RunningNumber::reset('STUDENT_CODE', '672', 0);

RunningNumber::generate('STUDENT_CODE', '672', 3);
// 673001

RunningNumber::delete('STUDENT_CODE', '672');

```
This is from my implementation.

```php
namespace App\Observers;

use App\Models\Student;
use App\Models\EducationLevel;
use Soap\Laravel\RunningNumbers\RunningNumber;

class StudentObserver
{
    /**
     * Handle the Student "creating" event.
     *
     * @return void
     */
    public function creating(Student $student)
    {
        if (empty($student->student_code)) {
            $level = EducationLevel::find($student->education_level_id)->level;
            $prefix = ($student->registered_at->year + 543) % 100 . $level;
            $student->student_code = RunningNumber::generate('STUDENT_CODE', $prefix, 3);
        }
    }
}

```

## Artisan Command
### List

```php
Usage:
  runningnumber:list [<type> [<prefix>]]

Arguments:
  type                  Type of running number
  prefix                Prefix before running number
```

### Generate

```php
Usage:
  runningnumber:generate [options] [--] <type> <prefix>

Arguments:
  type                             Type of running number
  prefix                           Prefix before running number
```

### Reset

```php
Usage:
  runningnumber:reset [options] [--] <type> <prefix>

Arguments:
  type                  Type of running number
  prefix                Prefix before running number

Options:
      --value[=VALUE]   Value to reset running number to [default: "1"]
```

### Delele

```php
Usage:
  runningnumber:delete <type> <prefix>

Arguments:
  type                  Type of running number
  prefix                Prefix before running number

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
