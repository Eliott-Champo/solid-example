<?php

namespace App\Providers;

use App\Contracts\ProviderInterface;
use Laravel\Socialite\Facades\Socialite;

class SocialiteProvider implements ProviderInterface
{
    public function connectTo($socialNetwork)
    {
        return Socialite::driver($socialNetwork);
    }
}
