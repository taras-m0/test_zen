<?php
/**
 * For zenclass.
 * User: ttt
 * Date: 05.08.2019
 * Time: 21:19
 */

include_once 'vendor/autoload.php';
try{
    $class = "\\API\\" . ucfirst(strtolower($_GET['method']));
    /** @var Controller $controller */
    $controller = new $class();
    $controller->validate();

    print json_encode([
        'status' => "ok",
        'payload' => $controller->run(),
        'message' => $controller->message,
    ], JSON_PRETTY_PRINT);

}catch (Exception $e){
    print json_encode([
        'status' => "error",
        'message' => $e->getMessage(),
    ], JSON_PRETTY_PRINT);
}