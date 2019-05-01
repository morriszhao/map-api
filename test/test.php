<?php

include '../vendor/autoload.php';
use Map\Tengxun\TengxunMapApi;


$address = '四川省成都市天府五街';


$txMapKey = 'VTKBZ-UYAK4-UBHUA-X4OTJ-NX2D5-UAFWE';
$txMapSecret = 'J2EzGkyCBVmVzLsK6n9y3xEuNJXdI8M';


$map = new TengxunMapApi($txMapKey, $txMapSecret);
print_r($map->getGeocoder($address));