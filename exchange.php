<?php

list($from, $to) = @explode('/', $_GET['q']);

$to = preg_replace('/[^a-z]+/','',strtolower($to));
$url = "http://www.ecb.int/rss/fxref-$to.html";

$file = 'cache/'.$to;

$exchange = 1;

if(!file_exists($file) || filemtime($file)+3600 < time()){
    if(preg_match('/1 EUR buys ([0-9\.]+) /', @file_get_contents($url), $matches)){
        $exchange = $matches[1];
        file_put_contents($file, $exchange);
    }
}else{
    $exchange = file_get_contents($file);
}

echo $exchange;

