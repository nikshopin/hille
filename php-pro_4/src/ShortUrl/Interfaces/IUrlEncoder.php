<?php

namespace App\ShortUrl\Interfaces;

use InvalidArgumentException;

interface IUrlEncoder
{
    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return string
     */
    public function encodeUrlToCode(string $url): string;
}
