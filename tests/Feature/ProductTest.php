<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private $path;

    public function setUp(): void
    {
        parent::setUp();

        $this->path = public_path('img/1.jpeg');
    }

    public function testStoreValid()
    {
        $image = $this->uploadImage();

        $params = [
            'name' => fake()->sentence($nbWords = 6),
            'description' => fake()->paragraph($nbSentences = 5),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'image' => $image
        ];

        $response = $this->json('POST', "/api/v1/products", $params);
        $response->assertStatus(201)
            ->assertJsonFragment([
                'message' => 'product created !'
            ]);
    }

    public function testStoreFail()
    {
        $params = [
            'name' => fake()->sentence($nbWords = 6),
            'description' => fake()->paragraph($nbSentences = 5),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        ];

        $response = $this->json('POST', "/api/v1/products", $params);
        $response->assertStatus(422)
            ->assertJsonFragment([
                "message" => "The image field is required.",
                "errors" => [
                    "image" => [
                        "The image field is required."
                    ]
                ]
            ]);
    }

    public function testUpdateValid()
    {
        $product = $this->createDummyProduct();

        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
        $product->name = 'product-2';

        $response = $this->json('PUT', "/api/v1/products/{$product->id}", $product->toArray());
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'product updated !'
            ]);

        $this->assertDatabaseMissing('products', [
            'name' => 'product-1',
        ]);
        $this->assertDatabaseHas('products', [
            'name' => 'product-2',
        ]);
    }

    public function testDelete()
    {
        $product = $this->createDummyProduct();

        $response = $this->json('DELETE', "/api/v1/products/{$product->id}", $product->toArray());
        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'product deleted !'
            ]);

        $this->assertSoftDeleted('products', [
            'id' => $product->id
        ]);
    }

    public function testRestore()
    {
        $product = $this->createDummyProduct();
        $this->testDelete();
        $product->restore();
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
    }

    protected function uploadImage()
    {
        return new UploadedFile($this->path, '1.jpeg', 'image/jpeg', 0, true);
    }
}
