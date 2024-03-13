<?php

namespace App\ShortUrl;

use App\ShortUrl\Exceptions\DataNotFoundException;
use App\ShortUrl\Interfaces\IUrlRepository;
use \Exception;

class FileRepository implements IUrlRepository
{
    protected static string $file;

    public function __construct(){
        self::$file = getcwd() . "/fileRepository/ShortUrlRepo.Json";
    }

    public function createFile(): void{
        $directory = getcwd() . "/fileRepository";
        if (!(is_dir("$directory"))){
            mkdir("$directory");
        }
        file_put_contents(self::$file, '', FILE_APPEND);
    }

    /**
     * @throws Exception
     */
    public function writeIn(string $url, string $code): bool
    {
        if (!(file_exists(self::$file))){
            $this->createFile();
        }
        $data = json_encode(array($url => $code));
        try{
            file_put_contents(self::$file, $data, FILE_APPEND);
            return true;
        }catch(Exception){
            throw new Exception('Не получилось сохранит в файл данный');
        }
    }

    public function fileRepositoryIsEmpty(): bool{

        return (false != json_decode(file_get_contents(self::$file)))??  false;
    }

    public function issetInRepo(string $data): bool
    {
        if (!($this->fileRepositoryIsEmpty())){
            return false;
        }
        $arr = file_get_contents(self::$file);
        $res =array_key_exists($data, $arr);
        if ($res == false){
            $arr =array_flip($arr);
            return array_key_exists($data, $arr);
        }
        return $res;
    }

    /**
     * @param string $url
     * @return string
     * @throws DataNotFoundException
     */
    public function getCodeByUrl(string $url): string
    {
       try{
           $arr = (array)json_decode( file_get_contents(self::$file), true);
           if ($arr != false){
                return $arr["$url"];
           }else{
                throw new DataNotFoundException('В файле не найдено связки URL=>CODE' );
           }
       }catch (\Exception  $e){
           throw new DataNotFoundException($e->getMessage());
       }
    }

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string
     */
    public function getUrlByCode(string $code): string
    {
        $arr = json_decode(file_get_contents(self::$file),true);
        $arr = array_flip($arr);
        try{
            if (array_key_exists("$code", $arr)){
                return $arr[$code];
            }else{
            throw new DataNotFoundException('В файле не найдено связки CODE=>URL');
            }
        }catch(DataNotFoundException){
            return false;
        }
    }
}