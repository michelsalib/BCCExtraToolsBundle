# Intro to ExtraTools

It a bundle that contains some usefull symfony2 tools.

## Features:

- a `bcc:trans:update` command that extract all your missing i18n message from your twig templates and saves into yaml, xliff or php translation files.

## Installation and configuration:

### Get the bundle

`git submodule add git://github.com/michelsalib/ExtraToolsBundle.git vendor/bundles/BCC/ExtraToolsBundle`

### Register the namespace

    // app/autoload.php
    $loader->registerNamespaces(array(
        'BCC' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    ));

### Add ExtraToolsBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new BCC\ExtraToolsBundle\ExtraToolsBundle(),
            // ...
        );
    }

## Usage examples:

### bcc:trans:update command example

You now have the new command. You can use it as follows:

- To extract messages from your bundle and display in the console:

    `bcc:trans:update --dump-messages fr MyBundle`

- You can save them to the `MyBundle\Resources\translations` directory:

    `bcc:trans:update --force fr MyBundle`

- In another language:

    `bcc:trans:update --force en MyBundle`

- Specify the output format with the `--output-format` option (either `yml`, `xliff` or `php`):

    `bcc:trans:update --output-format="xliff" --force en MyBundle`

- Change the prefix used for newly added messages with the `--prefix` option:

    `bcc:trans:update --output-format="xliff" --force --prefix='myprefix' en MyBundle`
