<?php

namespace App\Networks;

use Exception;
use App\Models\Facebook;
use Illuminate\Support\Facades\Http;
use App\Abstracts\SocialNetworkAbstract;
use App\Contracts\SocialNetworkInterface;

class FacebookNetwork extends SocialNetworkAbstract implements SocialNetworkInterface
{
    protected $domain = 'facebook';

    protected function redirectTo()
    {
        return $this->provider->connectTo($this->domain)
            ->scopes(['pages_manage_posts'])
            ->redirect();
    }

    protected function getAccessTokens()
    {
        return [
            'token' => auth()->user()->profile->facebook->token,
        ];
    }

    protected function getDomain()
    {
        return $this->domain;
    }

    protected function getUserByTokens($token)
    {
        try {
            return $this->provider->connectTo($this->domain)->userFromToken($token['token']);
        } catch (Exception  $e) {
            //
            session()->flash('message', $e->getMessage());
        }
    }


    public function persistUser($user)
    {
        return Facebook::updateOrCreate(
            ['facebook_id' =>  $user->id],
            [
                'profile_id' => auth()->user()->profile->id,
                'facebook_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $this->getImageUrl($user->avatar),
                'page_id' => $this->userPages($user)['page_id'],
                'page_name' => $this->userPages($user)['page_name'],
                'token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in' => $user->expiresIn,
            ]
        );
    }

    public function getImageUrl($avatar)
    {
        $imageData = base64_encode(file_get_contents($avatar));
        return 'data:image/png;base64,' . $imageData;
    }

    public function userPages($user)
    {
        $url = "https://graph.facebook.com/{$user->id}/accounts?fields=name&access_token=&access_token={$user->token}";
        $response = Http::get($url);
        $pages = collect($response['data']);

        return [
            'page_id' => $pages->pluck('id')->first() ? $pages->pluck('id')->first() : null,
            'page_name' => $pages->pluck('name')->first() ? $pages->pluck('name')->first() : null,
        ];
    }
}
