<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Shelf;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to create the product inside existing shelf
     *
     * @return void
     */
    public function test_product_created_successfully()
    {
        $shelf =  Shelf::factory()->create();

        $response = $this->post('/api/products/' . $shelf->id);
        $response->assertStatus(200);
    }

     /**
     * Test to create the duplicate product inside existing shelf
     *
     * @return void
     */
    public function test_duplicate_product_throws_validation_error()
    {
        $shelf =  Shelf::factory()->create();

        $response = $this->post('/api/products/' . $shelf->id);
        $response->assertStatus(200);

        $response = $this->post('/api/products/' . $shelf->id);
        $response->assertStatus(422);
    }
}
