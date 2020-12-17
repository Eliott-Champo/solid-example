<?php

namespace App\Networks;

use Exception;
use App\Models\Twitter;
use App\Abstracts\SocialNetworkAbstract;
use App\Contracts\SocialNetworkInterface;

class TwitterNetwork extends SocialNetworkAbstract implements SocialNetworkInterface
{
    protected $domain = 'twitter';

    protected function getDomain()
    {
        return $this->domain;
    }

    protected function redirectTo()
    {
        return $this->provider->connectTo($this->domain)
            ->redirect();
    }

    protected function getAccessTokens()
    {
        return [
            'token' => auth()->user()->profile->twitter->token,
            'secret' => auth()->user()->profile->twitter->token_secret,
        ];
    }

    protected function getUserByTokens($tokens)
    {
        try {
            return $this->provider->connectTo($this->domain)->userFromTokenAndSecret($tokens['token'], $tokens['secret']);
        } catch (Exception  $e) {
            session()->flash('message', $e->getMessage());
        }
    }

    protected function persistUser($user)
    {
        return Twitter::updateOrCreate(
            ['facebook_id' =>  $user->id],
            [
                'profile_id' => auth()->user()->profile->id,
                'twitter_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'token' => $user->token,
                'token_seccret' => $user->secretToken,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
            ]
        );
    }
}
