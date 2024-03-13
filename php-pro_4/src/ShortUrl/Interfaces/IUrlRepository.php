<?php

namespace App\ShortUrl\Interfaces;

use App\ShortUrl\Exceptions\DataNotFoundException;
use App\ShortUrl\ValueObject\DataPair;

interface IUrlRepository
{
    public function writeIn(string $url, string $code);

    public function issetInRepo(string $data): bool;


    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string
     */
    public function getCodeByUrl(string $url): string;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string
     */
    public function getUrlByCode(string $code): string;
}