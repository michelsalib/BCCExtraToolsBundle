# Intro to ExtraTools

It a bundle that contains some usefull symfony2 tools.

[![Build Status](https://secure.travis-ci.org/michelsalib/BCCExtraToolsBundle.png?branch=master)](http://travis-ci.org/michelsalib/BCCExtraToolsBundle)

## Warning

The `bcc:trans:update` command had been merged into the framework and thus won't be maintained here anymore. The new name is `translation:extract`.

## Features:

- a `bcc:trans:update` command that extract all your missing i18n message from your twig templates and saves into yaml, xliff, php or pot translation files.
- a twig extension that translates dates and contries
- a date formatter that formats and translates dates and also parses multiple forms of localized date string
- a unit converter that is ignly extensible and convert units

## Installation and configuration:

### Get the bundle

Add to your `/deps` file :

```
[BCCExtraToolsBundle]
    git=http://github.com/michelsalib/BCCExtraToolsBundle.git
    target=/bundles/BCC/ExtraToolsBundle
```

And make a `php bin/vendors install`.

### Register the namespace

``` php
<?php

    // app/autoload.php
    $loader->registerNamespaces(array(
        'BCC' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    ));
```

### Add ExtraToolsBundle to your application kernel

``` php
<?php

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new BCC\ExtraToolsBundle\BCCExtraToolsBundle(),
            // ...
        );
    }
```

### Register the twig extension

*If you want to use the twig extension you must have the apache intl module installed.*

Add to your `config.yml`:

``` yml
#BCC configuration
services:
    bcc.twig.extension:
        class: BCC\ExtraToolsBundle\Twig\TwigExtension
        tags:
            -  { name: twig.extension }
```

## Usage examples:

### bcc:trans:update command example

You now have the new command. You can use it as follows:

- To extract messages from your bundle and display in the console:

    `bcc:trans:update --dump-messages fr MyBundle`

- You can save them to the `MyBundle\Resources\translations` directory:

    `bcc:trans:update --force fr MyBundle`

- In another language:

    `bcc:trans:update --force en MyBundle`

- Specify the output format with the `--output-format` option (either `yml`, `xliff`, `php` or `pot`):

    `bcc:trans:update --output-format="xliff" --force en MyBundle`

- Change the prefix used for newly added messages with the `--prefix` option:

    `bcc:trans:update --output-format="xliff" --force --prefix='myprefix' en MyBundle`

### Twig extensions examples

Translate a date value :

- `{{ user.createdAt | localeDate }}` to have a medium date and no time, in the current locale

- `{{ user.createdAt | localeDate('long','medium') }}` to have a long date and medium time, in the current locale

Translate a contry :

- `{{ user.country | country }}` to have the country, in the current locale

- `{{ user.country | country('c
ountry does not exist') }}` Define the returned value if the country does not exist

### DateFormatter examples

Get the service:

``` php
<?php

$dateFormatter = $container->get('bcc_extra_tools.date_formatter');

```

Parse a date:

``` php
<?php

$date = $dateFormatter->parse('November 1, 2011', 'en'); // obtains a datetime instance

```

Format a date:

``` php
<?php

echo $dateFormatter->format($date, 'long', 'none', 'fr'); // echoes : "1 novembre 2011"

```

Note that the locale parameter (here 'fr' and 'en') are optionnal, default is the current locale.

### Unit converter examples

Get the service:

``` php
<?php

$unitConverter = $container->get('bcc_extra_tools.unit_converter');

```

Convert a value:

``` php
<?php

echo $unitConverter->parse(1000, 'm', 'km'); // echoes : 1

```

Guess the source unit:

``` php
<?php

echo $unitConverter->parse('1h', 'm'); // echoes : 60

```

More examples in the tests: ./Tests/Util/UnitConverterTest.
