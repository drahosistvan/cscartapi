<?php

if (!function_exists('curl_init')) {
    throw new Exception('CS-Cart API Class needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('CS-Cart API Class needs the JSON PHP extension.');
}

class CSCartApi {

    const VERSION = '0.1';

    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'cscart-api-php-beta-0.1',
    );
    protected $apiKey;
    protected $userLogin;
    protected $apiUrl;

    public function __construct($config) {
        $this->setUserLogin($config['user_login']);
        $this->setApiKey($config['api_key']);
        $this->setApiUrl($config['api_url']);
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function setUserLogin($userLogin) {
        $this->userLogin = $userLogin;
    }

    public function setApiUrl($apiUrl) {
        $this->apiUrl = trim($apiUrl, '/');
    }

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getUserLogin() {
        return $this->userLogin;
    }

    public function getApiUrl() {
        return $this->apiUrl;
    }

    public function api($method, $path, $data = '') {
        if (isset($method) && isset($path) && !empty($method) && !empty($path)) {
            return $this->makeRequest($path, $method, $data);
        } else {
            // error
        }
    }

    protected function makeRequest($url, $method, $data = '', $ch = null) {
        if (!$ch) {
            $ch = curl_init();
        }

        $opts = self::$CURL_OPTS;
        //$opts[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');

        $opts[CURLOPT_URL] = $this->apiUrl . $url;

        if (isset($opts[CURLOPT_HTTPHEADER])) {
            $existing_headers = $opts[CURLOPT_HTTPHEADER];
            $existing_headers[] = 'Expect:';
            $opts[CURLOPT_HTTPHEADER] = $existing_headers;
        } else {
            $opts[CURLOPT_HTTPHEADER] = array('Expect:');
        }
        $authString = $this->userLogin . ":" . $this->apiKey;
        //$authToken = base64_encode($authString);
        $headers = array(
            'Content-Type: application/json'
        );
        //print $header."<br/>".$authString;
        //die();
        curl_setopt($ch, CURLOPT_USERPWD, $authString);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if (is_array($data)) {
            $postdata = json_encode($data);
        } else {
            $postdata = $data;
        }
        curl_setopt_array($ch, $opts);
        //die($postdata);
        switch ($method) {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postdata))
                );
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postdata))
                );
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                break;
        }


        $result = curl_exec($ch);


        curl_close($ch);
        return $result;
    }

}