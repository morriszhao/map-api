<?php

include '../vendor/autoload.php';
use Map\Tengxun\TengxunMapApi;


$address = '四川省成都市天府五街';


$txMapKey = '';
$txMapSecret = '';


$map = new TengxunMapApi($txMapKey, $txMapSecret);
print_r($map->getGeocoder($address));