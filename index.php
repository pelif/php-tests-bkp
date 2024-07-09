<?php

require __DIR__ . '/vendor/autoload.php'; 

use App\Controllers\CustomerController;
use App\Enums\HttpMethod;
use App\Repositories\CustomerRepository;
use GuzzleHttp\Client;

$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$method = HttpMethod::tryFrom($_SERVER['REQUEST_METHOD']);

$client = new Client();

if($requestUri[0] === 'customers')  {

    $customerController = new CustomerController(new CustomerRepository);
    // $customerController->handleRequest();

    if(!$method) {
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']); 
        exit();
    }

    switch($method) {
        case HttpMethod::GET:
            if(isset($requestUri[1])) {
                echo $customerController->show($requestUri[1]);
            } else {                         
                echo $customerController->index();
            }            
            break;

        case HttpMethod::POST:
            $body = json_decode(file_get_contents('php://input'), true);                
            echo $customerController->create($body);
            break;

        case HttpMethod::PUT:
            if(isset($requestUri[1])) {
                $body = json_decode(file_get_contents('php://input'), true);                
                $body['id'] = (int) $requestUri[1];                 
                echo $customerController->update($body);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'ID is required for update']);
            }
            break;

        case HttpMethod::DELETE:
            if(isset($requestUri[1])) {
                echo $customerController->delete((int) $requestUri[1]);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'ID is required for delete']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method not allowed']); 
            exit();
    }
} 