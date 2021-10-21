<?php

namespace Radiate\Passwordless;

use Radiate\Routing\UrlGenerator;
use Stringable;

class LoginUrl implements Stringable
{
    /**
     * The user
     *
     * @var \Radiate\Auth\Authenticatable|\WP_User
     */
    protected $user;

    /**
     * The URL generator
     *
     * @var \Radiate\Routing\UrlGenerator
     */
    protected $url;

    /**
     * The passwordless config
     *
     * @var array
     */
    protected $config;

    /**
     * The URL to redirect to
     *
     * @var string|null
     */
    protected $redirect;

    /**
     * The URL expiry time
     *
     * @var int
     */
    protected $expiry;

    /**
     * Create the login URL instance
     *
     * @param \Radiate\Routing\UrlGenerator $url
     */
    public function __construct(UrlGenerator $url, ?array $config = null)
    {
        $this->url = $url;
        $this->config = $config;
        $this->expiry = 5 * MINUTE_IN_SECONDS;
    }

    /**
     * Set the user to login
     *
     * @param \Radiate\Auth\Authenticatable|\WP_User $user
     * @return static
     */
    public function forUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set a redirect URL
     *
     * @param string $redirect
     * @return static
     */
    public function redirectTo(string $redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Set the URL expiry time
     *
     * @param int $expiry
     * @return static
     */
    public function expiresin(int $expiry)
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Generate a temporary login URL
     *
     * @return string
     */
    public function generate()
    {
        $namespace = $this->config['namespace'] ?? 'passwordless';
        $route = $this->config['route'] ?? 'login';

        return $this->url->temporarySignedUrl(
            $this->url->rest("{$namespace}/{$route}/{$this->user->id}"),
            $this->expiry,
            ['redirect_to' => $this->redirect]
        );
    }

    /**
     * Get the URL when cast to as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->generate();
    }
}
