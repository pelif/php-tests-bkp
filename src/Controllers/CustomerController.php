<?php 

namespace App\Controllers;

use App\Repositories\CustomerRepository;

class CustomerController
{
    public function index()
    {
        $repository = new CustomerRepository();
        $customers = $repository->getCustomers();
        echo json_encode([
            'data' => [
                'customers' => $customers,
                'message' => 'Fetching all customers'
            ]
        ]);
    }

    public function show($id)
    {
        $repository = new CustomerRepository();
        $customer = $repository->findById($id);
        echo json_encode([
            'data' => [
                'customer' => $customer,
                'message' => 'Fetching customer'
            ]
        ]);
    }
}