<?php

namespace fl\curl;

require(__DIR__ . '/../vendor/autoload.php');

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
        //$this->defaultOptions[CURLOPT_USERAGENT] = $userAgent;
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
        ];
        $curl = new Curl($postOptions, 1);
        return $curl->post('https://pub.fsa.gov.ru/login');
    }

    public function filter(array $filterOptions)
    {

        $jayParsedAry = [
            "size" => 10,
            "page" => 0,
            "filter" => [
                "status" => [
                    6
                ],
                "idDeclType" => [],
                "idCertObjectType" => [],
                "idProductType" => [],
                "idGroupRU" => [],
                "idGroupEEU" => [],
                "idTechReg" => [],
                "idApplicantType" => [],
                "regDate" => [
                    "minDate" => null,
                    "maxDate" => null
                ],
                "endDate" => [
                    "minDate" => null,
                    "maxDate" => null
                ],
                "columnsSearch" => [
                    [
                        "name" => "number",
                        "search" => "",
                        "type" => 8,
                        "translated" => false
                    ]
                ],
                "idProductOrigin" => [],
                "idProductEEU" => [],
                "idProductRU" => [],
                "idDeclScheme" => [],
                "awaitForApprove" => null,
                "awaitOperatorCheck" => null,
                "editApp" => null,
                "violationSendDate" => null,
                "isProtocolInvalid" => null
            ],
            "columnsSort" => [
                [
                    "column" => "declDate",
                    "sort" => "DESC"
                ]
            ]
        ];
        $authorization = "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJpc3MiOiIyNjM4ZDY0My00ZDZjLTRjM2EtOGRkNi01YzE1ODgwY2RlNWEiLCJzdWIiOiJhbm9ueW1vdXMiLCJleHAiOjE2NjcyNTE5Mzh9.oyBtn_YBQejjHjrHvpyRclVxNAJ7qSrjapaR1KuDk72B_nrH4AEW8fZN-X7dTh9YAZn6gx6EdpDp8c_iZKr96g";
        $postOptions = $this->defaultOptions;

        $postOptions[CURLOPT_POSTFIELDS] = json_encode($jayParsedAry);
        $postOptions[CURLOPT_COOKIEJAR] = 'cookie.txt';

        $postOptions[CURLOPT_HEADER] = true;
        //$postOptions[CURLOPT_CUSTOMREQUEST] = "POST";
        $postOptions[CURLOPT_POST] = true;
        $postOptions[CURLOPT_RETURNTRANSFER] = true;
        $postOptions[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',
            'sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',

        ];

        $curl = new Curl($postOptions, 1);
        return $curl->post('https://pub.fsa.gov.ru/api/v1/rds/common/declarations/get');
    }

    public function checkToken()
    {
        $token = 'eyJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkYjg2OTkyZS05Y2M3LTQ3NjMtOTQ3Zi00MzdjMGNhZGJlZWIiLCJzdWIiOiJhbm9ueW1vdXMiLCJleHAiOjE2NjY5ODI2MjB9.8YIy304tZf9Vfx_kqcT_s2zbg7AdBXjradUXLuY4YkGwqGCV2loblU0Rs-wGxL3tBHQyp8ngbh9atUltnABNtA';
        $authorization = "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkYjg2OTkyZS05Y2M3LTQ3NjMtOTQ3Zi00MzdjMGNhZGJlZWIiLCJzdWIiOiJhbm9ueW1vdXMiLCJleHAiOjE2NjY5ODI2MjB9.8YIy304tZf9Vfx_kqcT_s2zbg7AdBXjradUXLuY4YkGwqGCV2loblU0Rs-wGxL3tBHQyp8ngbh9atUltnABNtA";

        $postOptions[CURLOPT_COOKIE] = 'PHPSESSID=u17GjfB2nIHVzbNW64wXPEeyP1BZv7iy; _ym_uid=1666886464699212167; _ym_d=1666886464; _ym_isad=1; JSESSIONID=B4FDB12E3C8199A051B511F07DC6918C';
        $postOptions[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',
            'sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',


        ];
        $curl = new Curl($postOptions, 1);

        return $curl->get('https://pub.fsa.gov.ru/token/is/actual/' . $token);
    }

    public function filterAlt()
    {
        $url = 'https://pub.fsa.gov.ru/api/v1/rds/common/declarations/get';
        $jayParsedAry = [
            "size" => 10,
            "page" => 0,
            "filter" => [
                "status" => [
                    6
                ],
                "idDeclType" => [],
                "idCertObjectType" => [],
                "idProductType" => [],
                "idGroupRU" => [],
                "idGroupEEU" => [],
                "idTechReg" => [],
                "idApplicantType" => [],
                "regDate" => [
                    "minDate" => null,
                    "maxDate" => null
                ],
                "endDate" => [
                    "minDate" => null,
                    "maxDate" => null
                ],
                "columnsSearch" => [
                    [
                        "name" => "number",
                        "search" => "",
                        "type" => 8,
                        "translated" => false
                    ]
                ],
                "idProductOrigin" => [],
                "idProductEEU" => [],
                "idProductRU" => [],
                "idDeclScheme" => [],
                "awaitForApprove" => null,
                "awaitOperatorCheck" => null,
                "editApp" => null,
                "violationSendDate" => null,
                "isProtocolInvalid" => null
            ],
            "columnsSort" => [
                [
                    "column" => "declDate",
                    "sort" => "DESC"
                ]
            ]
        ];
        $authorization = "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJpc3MiOiIyNjM4ZDY0My00ZDZjLTRjM2EtOGRkNi01YzE1ODgwY2RlNWEiLCJzdWIiOiJhbm9ueW1vdXMiLCJleHAiOjE2NjcyNTE5Mzh9.oyBtn_YBQejjHjrHvpyRclVxNAJ7qSrjapaR1KuDk72B_nrH4AEW8fZN-X7dTh9YAZn6gx6EdpDp8c_iZKr96g";
        $encodedData = json_encode($jayParsedAry);
        $curl = curl_init($url);
        $data_string = urlencode(json_encode($jayParsedAry));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [            
            'Content-Type: application/json',
            $authorization,
            'Referer: https://pub.fsa.gov.ru/rds/declaration',
            'Host: pub.fsa.gov.ru',
            'sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',

    
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
        //var_dump($httpReturnCode);

        echo '<pre>' . var_export(curl_getinfo($curl, CURLINFO_HEADER_OUT ), true) . '</pre>';
        //var_dump($result);
        //var_dump($error);
        return $result;
    }
}



//$pageDeclaration = $curl->get('https://pub.fsa.gov.ru/rds/declaration');
$page = new CurlRequest;
$post = [];
//echo '<pre>' . var_export($page->login(), true) . '</pre>';
echo '<pre>' . $page->filterAlt() . '</pre>';
echo '<pre>' . var_export($page->filter($post), true) . '</pre>';
//echo '<pre>' . var_export($page->checkToken(), true) . '</pre>';
//print_r();