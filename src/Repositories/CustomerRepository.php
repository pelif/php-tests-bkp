<?php 

namespace App\Repositories;

use App\Connection\MysqlConnection;
use PDO;

class CustomerRepository implements CustomerRepositoryInterface
{
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->conn = MysqlConnection::getInstance(); 
    }

    public function getCustomers(): array
    {
        $sql = "SELECT * FROM customers ORDER BY name ASC";
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

    public function insertCustomer(array|null $data): mixed
    {           
        $stmt = $this->conn->prepare("INSERT INTO customers (name, email) VALUES (:name, :email)");        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        
        if($stmt->execute()) 
            $this->findById((int) $this->conn->lastInsertId());
        
        return false;    
    }

    public function updateCustomer(array $data): bool
    {        
        $sql = "UPDATE customers SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'], 
            ':email' => $data['email'], 
            ':id' => $data['id']
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