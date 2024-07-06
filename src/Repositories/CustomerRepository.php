<?php 

namespace App\Repositories;

use App\Connection\MysqlConnection;
use PDO;

class CustomerRepository
{
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->conn = MysqlConnection::getInstance(); 
    }

    public function getCustomers(): array
    {
        $sql = "SELECT * FROM customers";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): array
    {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetchAll();
    }

    public function insertCustomer(string $name, string $email): bool
    {        
        $stmt = $this->conn->prepare("INSERT INTO customers (name, email) VALUES (:name, :email)");        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function updateCustomer(int $id, string $name, string $email): bool
    {
        $sql = "UPDATE customers SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name, 
            ':email' => $email, 
            ':id' => $id
        ]);
    }

    public function deleteCustomer(int $id): bool
    {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
  
    
}