CS-Cart API Class (v 1.0.x)

What is this?
=========

[CS-Cart](http://cs-cart.com/) is a wonderful open source Shopping Cart software.
This is an API wrapper class for CS-Cart v4.x API. With this tool, you can start requesting a CS-Cart store easily, and fast.

You can find more information about the CS-Cart API [here](http://docs.cs-cart.com/4.3.x/developer_guide/api/index.html).

Usage
=========

To use this tool, you need 3 parameters:

**user_login**

By default, the e-mail of the API user. Only administrators can access to the API!

**api_key**

The password, generated via the CS-Cart administrator panel.

**api_url**

Your shopping cart's main URL *(eg. http://example.com/)*

After you have these parameters, you can make API calls easily:

    $cscartapi = new CSCartApi(
        array(
            'api_key' => '2G1lp1EyRS99bVuv5J090G7640M04v3D',
            'user_login' => 'testapi@localhost.com',
            'api_url' => 'http://api-endpoint-shop-url.loc/'
        )
    );

	try {
	    $usergroups = $cscartapi->get("usergroups" );
	    print_r($usergroups);
	    
	    $data = array(
		    company_id => 3,
		    user_type => 'C',
		    email => 'demo@user.com'
	    );
	    $user = $cscartapi->create("users", $data );
	    print_r($user);
	    
	} catch (Exception $e) {
	    print $e->getMessage();
	}

You have 5 main methods: api(), get(), update(), create(), delete()

You can access to the API version via getApiVersion() method, or you can get the CS-Cart version via getCartVersion() method.

Versioning
==========
The versioning for this tool based on [Semantic Versioning 2.0.0](http://semver.org/).
