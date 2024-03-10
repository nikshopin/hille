<?php

namespace App\ShortUrl\Interfaces;

interface IUrlEncoder
{
    public function encodeUrlToCode(string $url): string;
}