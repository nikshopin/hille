<?php

namespace App\ShortUrl\Interfaces;

use InvalidArgumentException;

interface IUrlDecoder
{
    /**
     * @param string $code
     * @throws InvalidArgumentException
     * @return string
     */
    public function decodeCodeToUrl(string $code): string;
}
