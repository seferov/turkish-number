# Turkish number

[![Build Status](https://travis-ci.com/seferov/turkish-number.svg?branch=master)](https://travis-ci.com/seferov/turkish-number)

A PHP library converts numbers to words in Turkish.

It was highly inspired by https://github.com/hynkle/turkish_number which is a Ruby gem that does the same task.

## Installation

```
composer require seferov/turkish-number
```

## Usage

```php
use Seferov\TurkishNumber\TurkishNumber;

TurkishNumber::spell(3233); // returns 'üç bin iki yüz otuz üç'
```
