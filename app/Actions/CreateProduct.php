<?php

namespace App\Actions;

use App\Models\Product;

class CreateProduct {

    public function handle($shelf): Product
    {
        $code = 'PRD1234';
        if ($shelf->products()->where('code', $code)->exists()) {
            throw new \Exception('Product with this code already exist');
        }

        $product = Product::create([
            'code' => $code,
            'name' => 'Pisang'
        ]);

        $product->updateShelf($shelf->id);

        return $product;
    }

}