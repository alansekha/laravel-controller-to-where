<?php

namespace App\Services;

use App\Models\Product;

class ProductService {

    public function updateShelf($product, int $shelf_id): void
    {
        $product->update(['shelf_id' => $shelf_id]);
    }

    public function createProduct($shelf): Product
    {
        $code = 'PRD1234';
        if ($shelf->products()->where('code', $code)->exists()) {
            throw new \Exception('Product with this code already exist');
        }

        $product = Product::create([
            'code' => $code,
            'name' => 'Pisang'
        ]);

        $this->updateShelf($product, $shelf->id);

        return $product;
    }

}