<?php

namespace App\Http\Controllers;

use App\Contracts\SocialNetworkInterface;

class TwitterController extends Controller
{
    public function __construct(SocialNetworkInterface $provider)
    {
        $this->provider = $provider;
    }

    public function redirectToProvider()
    {
        return $this->provider->authorise();
    }

    public function handleProviderCallback()
    {
        $this->provider->callback();

        return redirect('dashboard');
    }
}
