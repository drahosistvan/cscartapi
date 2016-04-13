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
    $usergroups = $cscartapi->get("usergroups" );
    print_r($usergroups);
    
    $data = array(
	    company_id => 3,
	    user_type => 'C',
	    email => 'ao@cscart4beta2.loc'
    );
    $user = $cscartapi->create("users", $data );
    print_r($user);
    
} catch (Exception $e) {
    print $e->getMessage();
}

print "<br/>" . $cscartapi->getApiVersion();
print "<br/>" . $cscartapi->getCartVersion();
?>
