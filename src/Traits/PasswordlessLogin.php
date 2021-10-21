<?php

namespace Radiate\Passwordless\Traits;

use Radiate\Passwordless\Facades\PasswordlessLogin as Passwordless;

trait PasswordlessLogin
{
    /**
     * Get a passwordless login URL
     *
     * @param string|null $redirect
     * @param integer|null $expiry
     * @return string
     */
    public function getPasswordlessLink(?string $redirect = null, ?int $expiry = null)
    {
        $url = Passwordless::forUser($this);

        if ($redirect) {
            $url->redirectTo($redirect);
        }

        if ($expiry) {
            $url->expiresIn($redirect);
        }

        return $url->generate();
    }
}
