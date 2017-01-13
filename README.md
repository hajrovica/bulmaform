# BulmaForm

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

BulmaForm builds on top of my more general [Form](https://github.com/adamwathan/form) package by adding another layer of abstraction to rapidly generate markup for standard Bulma forms and inspired from Adam Wathan's [BootFrom](https://github.com/adamwathan/bootforms) package.

## Install

Via Composer

``` bash
$ composer require nisaac2fly/bulmaform
```

## Usage

``` php
$skeleton = new Isaac\BulmaForm();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email nathan@nathan-isaac.com instead of using the issue tracker.

## Credits

- [Nathan Isaac][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/nisaac2fly/bulmaform.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/nisaac2fly/bulmaform/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/nisaac2fly/bulmaform.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/nisaac2fly/bulmaform.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nisaac2fly/bulmaform.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/nisaac2fly/bulmaform
[link-travis]: https://travis-ci.org/nisaac2fly/bulmaform
[link-scrutinizer]: https://scrutinizer-ci.com/g/nisaac2fly/bulmaform/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/nisaac2fly/bulmaform
[link-downloads]: https://packagist.org/packages/nisaac2fly/bulmaform
[link-author]: https://github.com/nisaac2fly
[link-contributors]: ../../contributors
