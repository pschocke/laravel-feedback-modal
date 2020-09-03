# A Laravel Livewire component to get feedback from website visitors

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pschocke/laravel-feedback-modal.svg?style=flat-square)](https://packagist.org/packages/pschocke/laravel-feedback-modal)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/pschocke/laravel-feedback-modal/run-tests?label=tests)](https://github.com/pschocke/laravel-feedback-modal/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/pschocke/laravel-feedback-modal.svg?style=flat-square)](https://packagist.org/packages/pschocke/laravel-feedback-modal)

Add a feedback form to your TALL stack application to collect feedback from your visitors.

## Demo

<img src="http://storage.ausbildung-ms.de:9000/open-source/laravel-feedback.gif" alt="Laravel Feedback in action">

## Installation

This package comes without any styles. It assumes you have the styles for tailwind, tailwindui and AlpineJs installed.

You can install the package via composer:
```bash
composer require pschocke/laravel-feedback-modal
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="pschocke\FeedbackModal\FeedbackModalServiceProvider" --tag="migrations"
php artisan migrate
```

This package comes with translation files. You can publish them using:

```bash
php artisan vendor:publish --provider="pschocke\FeedbackModal\FeedbackModalServiceProvider" --tag="translations"
```

You should publish the livewire component using:

```bash
php artisan vendor:publish --provider="pschocke\FeedbackModal\FeedbackModalServiceProvider" --tag="views"
```

## Customization


### Changing the radio group items
You can customize the feedback-types that are available in the radio group by changing the corresponding array in your previously published translations:

```php
return [
    //...,
    'feedback' => [
            'type' => 'Type of feedback',
            'types' => [
                // every array key is an option in the radio group. You can customize them however you want.
                'error' => [
                    'title' => 'i found a mistake',
                    'description' => 'You found a bug that you want to report to us'
                ],
            ]
        ],
];
```
### Changing the style

After publishing the livewire component, you can edit it in any way you want.

## Usage
Just include the laravel livewire component:

``` html
<body>
    ...
    @livewire('feedback-modal')
</body>
```

### Usage with purgecss

If you use purgecss to minify your css (I highly recommend you do!),
you should publish the component to keep the classes used in the component
from getting purged.

### Getting the submitted feedback

You can get the submitted feedback using the eloquent model provided with this package:

```php
$feedbacks = \pschocke\FeedbackModal\AnonymousFeedback::all();
```

### Adding fields to the Feedback Model

You can add more fields to the model simply by adding them to the migration.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email patrick@ausbildung-ms.de instead of using the issue tracker.

## Credits

- [Patrick Schocke](https://github.com/pschocke)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
