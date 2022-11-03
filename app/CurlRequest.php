<?php

namespace fl\curl;

require(__DIR__ . '/../vendor/autoload.php');

//session_start();

class CurlRequest
{

    public string $userAgent;
    public array $defaultOptions =  [
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => ['Accept: application/json', 'Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true
    ];

    public function __construct()
    {
        $userAgent = UserAgentDesktop::rand();
        $this->defaultOptions[CURLOPT_USERAGENT] = $userAgent;
    }

    public function login()
    {
        $postRequest = [
            'username' => 'anonymous',
            'password' => 'hrgesf7HDR67Bd'
        ];
        $postOptions = $this->defaultOptions;
        $postOptions[CURLOPT_POSTFIELDS] = json_encode($postRequest);
        $postOptions[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
            'Origin: https://pub.fsa.gov.ru',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
        ];
        $postOptions[CURLOPT_POST] = true;
        $curl = new Curl($postOptions, 1);
        return $curl->post('https://pub.fsa.gov.ru/login');
    }

    public function filter(string $token, $filterParams)
    {
        
        $authorization = "Authorization: " . $token;
        $postOptions = $this->defaultOptions;

        $postOptions[CURLOPT_POSTFIELDS] = json_encode($filterParams);
        $postOptions[CURLOPT_HEADER] = true;
        $postOptions[CURLOPT_POST] = true;
        $postOptions[CURLOPT_RETURNTRANSFER] = true;
        $postOptions[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
        ];

        $curl = new Curl($postOptions, 1);
        return $curl->post('https://pub.fsa.gov.ru/api/v1/rds/common/declarations/get');
    }

    public function checkToken($token)
    {
        $authorization = "Authorization: " . $token;
            $postOptions[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',
        ];
        $curl = new Curl($postOptions, 1);
        $token = str_ireplace('Bearer ', '', $token);
        return $curl->get('https://pub.fsa.gov.ru/token/is/actual/' . $token);
    }


}



