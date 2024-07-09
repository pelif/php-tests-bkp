<?php 

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
                
class CustomerApiTest extends TestCase
{
    private \GuzzleHttp\Client $client; 

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://192.20.0.3/', 
            'http_errors' => false
        ]);
    }

    public function testCreateCustomers(): void
    {
        $response = $this->client->request('POST', 'customers', [     
            'json' => [
                'name' => 'John Doe',
                'email' => 'jXUeh@example.com',
            ]                   
        ]);  

        $this->assertEquals(200, $response->getStatusCode());        
        $this->assertStringContainsString("John Doe", $response->getBody()->getContents());
    }
    
    public function testGetCustomers(): void
    {
        $response = $this->client->get('customers');        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getBody()->getContents());      
    }

   
}