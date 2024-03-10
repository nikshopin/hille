<?php

namespace App\ShortUrl\ValueObject;

class DataPair{
    protected string $url;
    protected string $code;
    public function __construct(string $url, string $code){
        $this->url = $url;
        $this->code = $code;
    }
    public function getCodeFrom(): string{
        return $this->code;
    }
    public function getUrlFrom(): string{
        return $this->url;
    }



}

