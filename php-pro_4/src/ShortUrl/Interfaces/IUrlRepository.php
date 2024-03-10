<?php

namespace App\ShortUrl\Interfaces;

use App\ShortUrl\ValueObject\DataPair;

interface IUrlRepository
{
    public function writeTo($Url, string $code);

    public function issetInRepo(string $data, string $KeyOrValue): bool;

    public function getCodeByUrl(string $url): string;
    public function getUrlByCode(string $code): string;
}