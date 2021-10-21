<?php

namespace Radiate\Passwordless\Facades;

use Radiate\Support\Facades\Facade;

/**
 * @method static \Radiate\Passwordless\LoginUrl forUser(\Radiate\Auth\Authenticatable|\WP_User $user) Set the user to login
 * @method static \Radiate\Passwordless\LoginUrl redirectTo(string $redirect) Set a redirect URL
 * @method static \Radiate\Passwordless\LoginUrl expiresin(int $expiry) Set the URL expiry time
 * @method static string generate() Generate a temporary login URL
 *
 * @see \Radiate\Passwordless\LoginUrl
 */
class PasswordlessLogin extends Facade
{
    /**
     * Get the name of the component
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'passwordless';
    }
}
