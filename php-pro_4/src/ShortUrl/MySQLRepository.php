<?php

namespace App\ShortUrl;

use App\ShortUrl\Interfaces\IUrlRepository;

class MySQLRepository implements IUrlRepository
{

    public
    function writeIn($Url, string $code)
    {
        // TODO: Implement writeTo() method.
    }

    public
    function issetInRepo(string $data, string $KeyOrValue): bool
    {
        // TODO: Implement issetInRepo() method.
    }

    public
    function getCodeByUrl(string $url): string
    {
        // TODO: Implement getCodeByUrl() method.
    }

    public
    function getUrlByCode(string $code): string
    {
        // TODO: Implement getUrlByCode() method.
    }
}