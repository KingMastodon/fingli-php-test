<?php

namespace fl\curl;

ini_set('display_errors', 0);

require_once('CurlRequest.php');


session_start();

$filterConstructor = [
    "size" => $_POST['size'],
    "filter" =>
    [
        'columnsSearch' => [
            [
                "name" => "number",
                "search" => $_POST['number'],
                "type" => "8",
                "translated" => "false"
            ]
        ],
        "endDate" => [
            "minDate" => $_POST["endDate_minDate"],
            "maxDate" => $_POST["endDate_maxDate"]
        ],
        "regDate" => [
            "minDate" => $_POST["regDate_minDate"],
            "maxDate" => $_POST["regDate_maxDate"]
        ],
    ],
];
if (!empty($_POST['status'])) {
    $filterConstructor["filter"]["status"] = [
        $_POST['status']
    ];
}

$currentToken = $_SESSION["currentToken"];

$page = new CurlRequest;

$isTokenCorrectRequest = $page->checkToken($currentToken);
$isTokenCorrect = filter_var($isTokenCorrectRequest->body, FILTER_VALIDATE_BOOLEAN);
if (!$isTokenCorrect) {
    $resultLogin = $page->login();
    $resultLoginHeaders = $resultLogin->headers;
    $resultLoginHeadersAuthorisation = $resultLoginHeaders['authorization'];
    $_SESSION["currentToken"] = $resultLoginHeadersAuthorisation[0];
}

$filterResult = $page->filter($_SESSION["currentToken"], $filterConstructor);


if($filterResult->code == '200'){
    $result = array_map(function ($object) {

        $keys = ['id', 'idStatus','number', 'declDate', 'declEndDate', 'productFullName', 'applicantName', 'manufacterName', 'productOrig', 'declObjectType'];    
        $object = array_filter($object, fn($n) => in_array($n, $keys) , ARRAY_FILTER_USE_KEY);        
        return $object;
    
    }, $filterResult->data['items']);
}else{
    $result['code'] = $filterResult->code;
    $result['errorText'] = $filterResult->errorText;
    $result['errorDesc'] = $filterResult->errorDesc;
    $errorDescSecondary = json_decode($filterResult->body, true);
    $result['errorDesc2'] = $errorDescSecondary['error'] . ':  ' . $errorDescSecondary['message'];
}

echo json_encode($result);

