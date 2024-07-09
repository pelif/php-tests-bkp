<?php 

namespace App\Controllers;

use App\Repositories\CustomerRepositoryInterface;

class CustomerController
{

    public function __construct(private CustomerRepositoryInterface $repository)
    {        
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

    public function create(array|null $data): string
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