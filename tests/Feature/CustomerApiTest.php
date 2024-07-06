<?php 

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
// use GuzzleHttp\Client;
use GuzzleHttp\Client;
                
class CustomerApiTest extends TestCase
{
    private \GuzzleHttp\Client $client; 

    protected function setUp(): void
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost/', 
            'http_errors' => false
        ]);
    }

    public function testGetCustomers()
    {
        $response = $this->client->request('GET', 'customers');
        $response->assertStatus(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
    }
}