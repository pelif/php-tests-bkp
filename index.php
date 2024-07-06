<?php

require __DIR__ . '/vendor/autoload.php'; 

use App\Controllers\CustomerController;
use App\Enums\HttpMethod;
use GuzzleHttp\Client;

// $requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
// $method = HttpMethod::tryFrom($_SERVER['REQUEST_METHOD']);

$client = new Client();
var_dump($client); 

// if($requestUri[0] === 'customer')  {
    
//     $customerController = new CustomerController();

//     if(!$method) {
//         http_response_code(405);
//         echo json_encode([
//             'message' => 'Method not allowed'
//         ]); 
//         exit();
//     }

//     switch($method) {
//         case HttpMethod::GET:
//             if(isset($requestUri[1])) {
//                 $customerController->show($requestUri[1]);
//             } else {
//                 $customerController->index();
//             }            
//             break;


//         default:
//             http_response_code(405);
//             echo json_encode([
//                 'message' => 'Method not allowed'
//             ]); 
//             exit();
//     }
// } 