<?php

namespace App\Abstracts;

use App\Contracts\ProviderInterface;

abstract class SocialNetworkAbstract
{
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    abstract protected function persistUser($user);
    abstract protected function redirectTo();
    abstract protected function getAccessTokens();
    abstract protected function getDomain();
    abstract protected function getUserByTokens($token);

    public function authorise()
    {
        return $this->redirectTo();
    }

    public function callback()
    {
        $user = $this->provider->connectTo($this->getDomain())->user();

        return $this->persistUser($user);
    }

    public function user()
    {
        $tokens = $this->getAccessTokens();

        $user = $this->getUserByTokens($tokens);

        return $this->persistUser($user);
    }
}
