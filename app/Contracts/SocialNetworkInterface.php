<?php

namespace App\Contracts;

interface SocialNetworkInterface
{
    public function authorise();
    public function callback();
    public function user();
}
