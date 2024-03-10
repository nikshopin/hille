<?php

use App\ShortUrl\TransformUrl;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/autoload.php';
$test = new \App\ShortUrl\FileRepository();
//$code = new TransformUrl('file');
$test->writeTo('https://www.europart.com.ua', 'ErOgdHo');
