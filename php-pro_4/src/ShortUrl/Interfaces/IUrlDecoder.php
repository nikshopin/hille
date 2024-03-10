<?php
namespace App\ShortUrl\Interfaces;

use InvalidArgumentException;
interface IUrlDecoder
{
    public function decodeCodeToUrl(string $code): string;
}