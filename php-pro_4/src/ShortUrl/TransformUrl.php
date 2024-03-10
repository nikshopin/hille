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
     * @param int $lengCode
     */
    public function __construct(/*IValidatorUrl $valid,*/ IUrlRepository $repo, int $lengthCode = self::LENGTH_CODE)
    {
        $this->repo = $repo;
//        $this->valid = $valid;
        $this->lengthCode = $lengthCode;
    }
    public function encodeUrlToCode(string $url): string
    {
        $this->valid->validUrl($url);
        try{
           $query =  $this->repo->getCodeByUrl($url);
        }catch (DataNotFoundException){
            $this->repo->writeTo($url, $this->generetCodeByUrl($url, $this->lengthCode));
        }
        return $url;
    }

    public function decodeCodeToUrl(string $code): string
    {
        return $this->repo->getUrlByCode($code);;
    }

    public function generetCodeByUrl(string $url, int $lengCode){
        $symbol = ['a','b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2','3', '4', '5', '6', '7', '8', '9', '0'];
        $specsymbol = str_replace($symbol, "", "$url" );
        $litlsymbol = str_ireplace("$specsymbol", '', $url);
        $code = substr(str_shuffle( $litlsymbol . strtoupper($litlsymbol)), '0', "$lengCode");
         if ($this->repo->issetInRepo($code, 'code')){
             $this->generetCodeByUrl($url, $lengCode);
        }
         return $code;
    }
}

