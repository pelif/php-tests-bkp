<?php 

namespace App\Controllers;

use App\Repositories\CustomerRepositoryInterface;

class CustomerController
{

    public function __construct(private CustomerRepositoryInterface $repository)
    {        
    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        
        switch ($method) {
            case 'POST': 
                $body = json_decode(file_get_contents('php://input'), true);
                $this->create($body);
                break;
            
            case 'PUT':
                $body = json_decode(file_get_contents('php://input'), true);
                $this->update($body);
                break;

            case 'GET':
                if (isset($_GET['id'])) {
                    echo $this->show((int)$_GET['id']);
                } else {
                    echo $this->index();
                }
                break;
    
            case 'DELETE':
                if (isset($_GET['id'])) {
                    echo $this->delete((int)$_GET['id']);
                } else {
                    http_response_code(400);
                    echo json_encode(['message' => 'ID is required for delete']);
                }
                break;    

            default: 
                http_response_code(405);
                echo json_encode([
                    'message' => 'Method not allowed'
                ]); 
                break;
        }
    }

    public function index(): string
    {        
        $customers = $this->repository->getCustomers();
        return json_encode([
            'data' => [
                'customers' => $customers,
                'message' => 'Fetching all customers'
            ]
        ]);
    }

    public function create(array $data): string
    {   
        $customer = $this->repository->insertCustomer($data);
        return json_encode([
            'data' => [
                'customer' => $customer,
                'message' => 'Customer created with success'        
            ]
        ]);

    }

    public function show(int $id): string
    {        
        $customer = $this->repository->findById($id);
        return json_encode([
            'data' => [
                'customer' => $customer,
                'message' => 'Fetching customer'
            ]
        ]);
    }

    public function update(array $data): string
    {   
        $customer = $this->repository->updateCustomer($data);
        return json_encode([
            'data' => [
                'customer' => $customer,
                'message' => 'Customer updated with success'
            ]
        ]);
    }

    public function delete(int $id): string
    {        
        $customer = $this->repository->deleteCustomer($id);
        return json_encode([
            'data' => [
                'customer' => $customer,
                'message' => 'Customer deleted with success'
            ]
        ]);
    }

}