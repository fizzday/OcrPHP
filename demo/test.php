<?php
/**
 * Created by PhpStorm.
 * User: fizz_long
 * Date: 2016/8/17
 * Time: 16:11
 */
require __DIR__.'/../vendor/autoload.php';
use Fizzday\OcrPHP\OcrPHP;

$file = __DIR__.'/test.jpg';

if (!file_exists($file)) die('file not exists');

//d(33);

$getfile = OcrPHP::file($file);

echo $getfile->run('id');



