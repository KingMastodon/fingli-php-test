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

    public function filterAlt()
    {
        $url = 'https://pub.fsa.gov.ru/login';
        $jayParsedAry = [
            'username' => 'anonymous',
            'password' => 'hrgesf7HDR67Bd'
        ];
        $authorization = "Authorization: Bearer null";
        $encodedData = json_encode($jayParsedAry);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [            
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',    
        ]);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        $httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        var_dump($httpReturnCode);

        echo '<pre>' . var_export(curl_getinfo($curl, CURLINFO_HEADER_OUT ), true) . '</pre>';
        var_dump($result);
        var_dump($error);
        return $result;
    }
}



