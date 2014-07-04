Nebumix/NeburtValidationBundle
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

### Register the routing definition in `app/config/routing.yml`:

``` yml
# app/config/routing.yml
Nebumix_rtV_routing:
    resource: "@NebumixrtValidationBundle/Resources/config/routing.yml"
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

### Create new file `app/config/securityRT.yml`:

``` yml
# app/config/securityRT.yml
parameters:
    nebumix_rtvalidation.check.class: Nebumix\rtValidationBundle\Controller\CheckController
```

### Import the new file in `app/config/config.yml`:

``` yml
# app/config/config.yml
imports:
    // ...
    - { resource: securityRT.yml }
```

Continua ...
