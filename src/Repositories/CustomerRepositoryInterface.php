<?php 

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function getCustomers(): array;
    public function findById(int $id): array;
    public function insertCustomer(array $data): mixed;
    public function updateCustomer(array $data): bool;
    public function deleteCustomer(int $id): bool;
}