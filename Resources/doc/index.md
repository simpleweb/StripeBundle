Getting Started With SimplewebStripeBundle
==========================================

## Prerequisites

This bundle has only been tested with Symfony 2.4.

## Installation

Installation is a quick (I promise!) 7 step process:

1. Download SimplewebStripeBundle using composer
2. Enable the Bundle
3. Configure the bundle

### Step 1: Download SimplewebStripeBundle using composer

Add SimplewebStripeBundle in your composer.json:

``` js
{
    "require": {
        "simpleweb/stripe-bundle": "~0.1@dev"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
php composer.phar update simpleweb/stripe-bundle
```

Composer will install the bundle to your project's `vendor/simpleweb` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Simpleweb\StripeBundle\SimplewebStripeBundle(),
    );
}
```

### Step 3: Configure the bundle

``` yaml
simpleweb_stripe:
    secret_key: %stripe_test_secret_key%
    publishable_key: %stripe_test_publishable_key%
```

### Step 4: Add our traits and entity listener to your User class

``` php
<?php
// src/Acme/UserBundle/Entity/User.php

namespace Acme\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser,
    Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\EntityListeners({"Simpleweb\StripeBundle\EntityListener\UserListener"})
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    use Simpleweb\SaaSBundle\Entity\Traits\Customer;
}
```
