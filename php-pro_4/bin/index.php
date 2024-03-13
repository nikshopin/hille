<?php

use App\ShortUrl\FileRepository;
use App\ShortUrl\TransformUrl;
use App\ShortUrl\ValidatorUrl;

require_once __DIR__ . '/../vendor/autoload.php';


$repo = new FileRepository();
$valid = new ValidatorUrl();
$transform = new TransformUrl($valid, $repo,);

echo $transform->encodeUrlToCode('https://europart.com.ua') . PHP_EOL;
echo $transform->decodeCodeToUrl('aUtTCrhm') . PHP_EOL;

