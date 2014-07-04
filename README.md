<<<<<<< HEAD
Nebumix/rtValidationBundle
=========================

A real time backend validation for Symfony2

## Installation

### Add bundle to your composer.json file

``` js
// composer.json

{
    "require": {
        // ...
        "nebumix/rt-validation-bundle": "dev-master"
    }
}
```

### Add bundle to your application kernel

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Nebumix\rtValidationBundle\NebumixrtValidationBundle(),
        // ...
    );
}
```

### Download the bundle using Composer

``` bash
$ php composer.phar update nebumix/rt-validation-bundle
```

### Install assets

Given your server's public directory is named "web", install the public vendor resources

``` bash
$ php app/console assets:install web
```

Optionally, use the --symlink attribute to create links rather than copies of the resources 

``` bash
$ php app/console assets:install --symlink web
```

Continua ...
=======
NeburtValidationBundle
======================

Real time validation for Symfony2
>>>>>>> f7cd109799de17b4a505210f111885269f2dc43c
