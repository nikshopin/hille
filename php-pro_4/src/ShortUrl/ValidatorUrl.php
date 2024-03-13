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
            }
            throw new InvalidArgumentException($url . ' не валидный URL');
        }catch (\InvalidArgumentException ){}
        return true;
    }

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function existingUrl(string $url):bool
    {
        $ch = curl_init("$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        try{
            if ($http_code >= 200 && $http_code < 400){
                curl_close($ch);
            }
            throw new InvalidArgumentException($url . ' не существует');
        }catch (InvalidArgumentException){}
        return true;
    }
}
