<?php

require_once '../src/CSCartApi.php';

$cscartapi = new CSCartApi(
    array(
        'api_key' => 'INSERT YOUR KEY HERE',
        'user_login' => 'hello@isti.hu',
        'api_url' => 'http://cscart436.loc/'
    )
);

print "<pre>";

try {
    $products = $cscartapi->get("products" );
    print_r($products);
} catch (Exception $e) {
    print $e->getMessage();
}

print "<br/>API Class version:" . $cscartapi->getApiVersion();
print "<br/>CS-Cart version" . $cscartapi->getCartVersion();