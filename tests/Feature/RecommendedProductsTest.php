<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecommendedProductsTest extends TestCase
{
    public function testErrorJsonStructure()
    {
        $response = $this->get('/api/products/recommended/wrong_text');

        $response->assertJsonStructure([
            'error' => [
                'input',
                'code',
                'message',
            ]
        ]);
    }

    public function testSuccessJsonStructure()
    {
        $response = $this->get('/api/products/recommended/kaunas');

        $response->assertJsonStructure([
            'city',
            'current_weather',
            'recommended_products' => [
                ['sku', 'name','price']
            ]
        ]);
    }

    public function testWrongInputOfTheCity()
    {
        $response = $this->get('/api/products/recommended/wrong_text');

        $data = [ 'error' => ['input' => 'wrong_text', 'code' => 404, 'message' => "Not Found"] ];
        
        $response->assertExactJson($data);
    }

    
}
