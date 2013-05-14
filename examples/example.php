<?php

require_once '../src/CSCartApi.php';

$cscartapi = new CSCartApi(
    array(
        'api_key' => '2G1lp1EyRS99bVuv5J090G7640M04v3D',
        'user_login' => 'testapi@localhost.com',
        'api_url' => 'http://cscart4beta2.loc/'
    )
);

print "<pre>";

try {
    $params = array(
        'status' => "A"
    );
    $products = $cscartapi->get("products/1", $params);
    print_r($products);
} catch (Exception $e) {
    print $e->getMessage();
}

print "<br/>" . $cscartapi->getApiVersion();
print "<br/>" . $cscartapi->getCartVersion();
?>
