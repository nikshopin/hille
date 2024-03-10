<?php
namespace App\ShortUrl;

use App\ShortUrl\Interfaces\IValidatorUrl;
use \InvalidArgumentException;
class ValidatorUrl implements IValidatorUrl
{
    public function validUrl(string $url): bool
    {
        try{
            if ( false !== (filter_var($url, FILTER_VALIDATE_URL))){
                $this->existingUrl($url);
                return true;
            }
        }
        catch (\InvalidArgumentException ){
            throw new InvalidArgumentException($url . ' не валидный URL');
         }
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function existingUrl(string $url):bool
    {
        $ch = curl_init("$url");
        $http_code = curl_getinfo("$ch", CURLINFO_HTTP_CODE);
        try{
            if ($http_code >= 200 && $http_code <400){
                return true;
            }
        }catch (InvalidArgumentException){
            throw new InvalidArgumentException($url . ' не существует');
        }
    }
}