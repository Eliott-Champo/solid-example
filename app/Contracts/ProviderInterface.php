<?php

namespace App\Contracts;

interface ProviderInterface
{
    public function connectTo($socialNetwork);
}
