<?php

namespace App\ShortUrl\Interfaces;

interface IValidatorUrl
{
    public function validUrl(string $url): bool;

    public function existingUrl(string $url): bool;
}