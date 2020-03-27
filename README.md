tengxunmapapi

地址转换为经纬度!


###安装
composer require zhaolm/map-api


###使用

```php

<?php

include '../vendor/autoload.php';
use Map\Tengxun\TengxunMapApi;


$address = '四川省成都市天府五街';


$txMapKey = '<YOUR KEY>';
$txMapSecret = '<YOU SECRET>';


$map = new TengxunMapApi($txMapKey, $txMapSecret);
print_r($map->getGeocoder($address));
```
