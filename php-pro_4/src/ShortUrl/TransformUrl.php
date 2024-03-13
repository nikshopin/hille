<?php
namespace App\ShortUrl;

use App\ShortUrl\Exceptions\DataNotFoundException;
use App\ShortUrl\Interfaces\IUrlDecoder;
use App\ShortUrl\Interfaces\IUrlEncoder;
use App\ShortUrl\Interfaces\IUrlRepository;
use App\ShortUrl\Interfaces\IValidatorUrl;

Class TransformUrl implements IUrlEncoder, IUrlDecoder
{
    const LENGTH_CODE= 8;
    protected IValidatorUrl $valid;
    protected IUrlRepository $repo;
    protected int $lengthCode;

    /**
     * @param IValidatorUrl $valid
     * @param IUrlRepository $repo
     * @param int $lengthCode
     */
    public function __construct(IValidatorUrl $valid, IUrlRepository $repo, int $lengthCode = self::LENGTH_CODE)
    {
        $this->repo = $repo;
        $this->valid = $valid;
        $this->lengthCode = $lengthCode;
    }
    public function encodeUrlToCode(string $url): string
    {
        $this->valid->validUrl($url);
        try{
           $code =$this->repo->getCodeByUrl($url);
        }catch (DataNotFoundException){
            $code = $this->generateCodeByUrl($url, $this->lengthCode);
            $this->repo->writeIn($url, $code);
        }
        return $code;
    }

    /**
     * @throws DataNotFoundException
     */
    public function decodeCodeToUrl(string $code): string
    {
        return $this->repo->getUrlByCode($code);
    }

    public function generateCodeByUrl(string $url, int $lengCode): string
    {
        $symbol = ['a','b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2','3', '4', '5', '6', '7', '8', '9', '0'];
        $specSymbol = str_replace($symbol, '', "$url" );
        $specSymbol = str_split($specSymbol);
        $littleSymbol = str_ireplace($specSymbol, '', $url);
        $code = substr(str_shuffle( $littleSymbol . strtoupper($littleSymbol)), '0', "$lengCode");
         if ($this->repo->issetInRepo($code)){
             $this->generateCodeByUrl($url, $lengCode);
        }
         return $code;
    }
}

