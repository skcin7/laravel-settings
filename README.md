# Laravel Settings - Laravel Package

Laravel package to achieve persistent settings easily in your Laravel project.

> Credit: This package is based on [anlutro/l4-settings](https://github.com/anlutro/laravel-settings) by [Andreas Lutro](anlutro@gmail.com). Credit to him for his great work.

### Table of Contents

- [Stability Notice](#stability-notice)
- [Requirements](#requirements)
- [Installation](#installation)
- [Contribution Guidelines](#contribution-guidelines)
- [Maintainers](#maintainers)
- [License](#license)

### Stability Notice

It's stable.

I'm actively using this package in my own Laravel projects for managing backups. I would appreciate all feedback/suggestions you may have by [opening a GitHub issue](https://github.com/skcin7/laravel-settings/issues/new).

### Requirements

- PHP 5.5
- Laravel

### Installation

**Use Composer**

It's super easy.

1. Run the following command: `composer require skcin7/laravel-settings`.

2. Publish the configuration file: `php artisan vendor:publish --provider="skcin7\LaravelSettings\ServiceProvider"`. After publishing, edit this configuration file (which will be located in `config/settings.php`) to your specific configuration needs.

3. Add the `Setting` facade to the aliases array in `config/app.php`: `Setting => skcin7\LaravelSettings\Facade::class`.,

### Contribution Guidelines

// TODO

### Maintainers

This package is maintained by [Nick Morgan](http://nicholas-morgan.com).

### License

This package is published under the [MIT License](https://github.com/skcin7/laravel-settings/blob/master/LICENSE.md).
