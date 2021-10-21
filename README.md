![Packagist Version](https://img.shields.io/packagist/v/radiate/passwordless?style=flat-square)
![GitHub license](https://img.shields.io/github/license/radiate-framework/passwordless?style=flat-square)

# Radiate Passwordless Login

A Radiate framework package to allow users to login with a link.

This simple package generates temporary login URLs that allow a user to login without a password.

## Installation

```bash
composer require radiate/passwordless
```

Register the service provider in your `functions.php` file:

```php
$app->register(Radiate\Passwordless\PasswordlessServiceProvider::class);

```

By default the package generates a REST API endpoint at `/wp-json/passwordless/login` but you are free to change this in the passwordless config.

```bash
wp radiate vendor:publish --tag=passwordless
```

## Usage

### Trait

You can add the `PasswordlessLogin` trait to your User model:

```php
<?php

namespace Plugin\Models;

use Radiate\Database\Models\User as Model;
use Radiate\Passwordless\Traits\PasswordlessLogin;

class User extends Model
{
    use PasswordlessLogin;
}

```

This provides a `getPasswordlessLink` method. The method will generate a link for the user to login without a password.

```php
<?php

// Redirect defaults to wp-admin.php
// expiry defaults to 5 minutes
$link = $user->getPasswordlessLink($redirect, $expiry);

```

### Facade

If you prefer, you can use the `PasswordlessLogin` facade to generate the URL:

```php
<?php

use Radiate\Passwordless\Facades\PasswordlessLogin;

$link = PasswordlessLogin::forUser($user)
    ->redirectTo('/')
    ->expiresIn(1 * MINUTE_IN_SECONDS)
    ->generate();


```

## Disclaimer

Temporary URLs are safe from tampering HOWEVER if someone gives the link to someone else, then their entire account is compromised. Use passwordless URLs with caution.
