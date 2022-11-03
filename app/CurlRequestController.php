<?php

namespace fl\curl;

ini_set('display_errors', 0);

require_once('CurlRequest.php');


session_start();

$filterConstructor = [
    "size" => $_POST['size'],
    "filter" => [
        "status" => [ $_POST['status'],
        ],
    ],
    "endDate" =>[
        "minDate"=>$_POST["endDate_minDate"],
        "maxDate"=> $_POST["endDate_maxDate"]
    ],
    "regDate" =>[
        "minDate"=>$_POST["regDate_minDate"],
        "maxDate"=> $_POST["regDate_maxDate"]
    ],
];


$currentToken = $_SESSION["currentToken"];

$page = new CurlRequest;

$isTokenCorrectRequest = $page->checkToken($currentToken);
$isTokenCorrect = filter_var($isTokenCorrectRequest->body, FILTER_VALIDATE_BOOLEAN);
if(!$isTokenCorrect){
    $resultLogin = $page->login();
    $resultLoginHeaders = $resultLogin->headers;
    $resultLoginHeadersAuthorisation = $resultLoginHeaders['authorization'];
    $_SESSION["currentToken"] = $resultLoginHeadersAuthorisation[0];
}

$filterResult = $page->filter($_SESSION["currentToken"], $filterConstructor);

echo json_encode($filterResult->data['items']);

/*

$currentToken = $_SESSION["currentToken"];



$page = new CurlRequest;


$isTokenCorrectRequest = $page->checkToken($currentToken);
$isTokenCorrect = filter_var($isTokenCorrectRequest->body, FILTER_VALIDATE_BOOLEAN);
var_dump($isTokenCorrect);
if(!$isTokenCorrect){
    $resultLogin = $page->login();
    $resultLoginHeaders = $resultLogin->headers;
    $resultLoginHeadersAuthorisation = $resultLoginHeaders['authorization'];
    var_dump($_SESSION["currentToken"]);
    $_SESSION["currentToken"] = $resultLoginHeadersAuthorisation[0];
}

$filterResult = $page->filter($_SESSION["currentToken"], []);

echo '<pre>' . var_export($filterResult->data['items'], true) . '</pre>';
*/