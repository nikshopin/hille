<?php

namespace App\ShortUrl;

use App\ShortUrl\Interfaces\IUrlRepository;

class FileRepository implements IUrlRepository
{
    public function createFile(): void{
        $file = getcwd() . "/fileRepository";
        if (!(is_dir("$file"))){
            $file = mkdir("$file");
        }
        $file = $file ."/ShortUrlRepo.Json";
        file_put_contents($file, '', FILE_APPEND);
    }


    public function writeTo($url, string $code)
    {
        $file = getcwd() . "/fileRepository/ShortUrlRepo.Json";
        if (!(file_exists($file))){
            $this->createFile();
        }
        $data = json_encode(array($url => $code));
        file_put_contents($file, $data, FILE_APPEND);
    }

    public function issetInRepo(string $data, string $keyOrValue): bool
    {
        $array = json_decode(file_get_contents($this->file), 'true');
        if($keyOrValue === 'key'){
            return array_key_exists($array["$data"]);
        }else{
            $array =array_flip($array);
            return array_key_exists($array["$data"]);

        }
    }

    public function getCodeByUrl(string $url): string
    {
       $array = json_decode(file_get_contents($this->file), 'true');
        return array_key_exists($array["$url"]);
    }

    public function getUrlByCode(string $code): string
    {
        $array = json_decode(file_get_contents($this->file), 'true');
        $array =array_flip($array);
        return array_key_exists($array["$code"]);
    }
}