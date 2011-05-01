# Intro to ExtraTools

It a bundle that contains some usefull symfony2 tools.

## Features:

- a trans:update command that extract all your missing i18n message from your twig templates and saves into yaml translation files.

## Installation and configuration:

### Get the bundle

git submodule add git://github.com/michelsalib/ExtraToolsBundle.git vendor/bundles/BCC/ExtraToolsBundle

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

You now have the new command. You can use it like that :

- To extract the messages of your bundle and display them in the console
    bcc:trans:update --dump-messages fr MyBundle

- You can save them
    bcc:trans:update --force fr MyBundle

- In another language
    bcc:trans:update --force en MyBundle

- Or if you want to chaneg the prefix used to generate the new messages
    bcc:trans:update --force --prefix='myprefix' en MyBundle
