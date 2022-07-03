<?php

namespace App\Http\Controllers\Api;

use App\Models\Shelf;
use App\Models\Product;
use App\Actions\CreateProduct;
use App\Jobs\createProductJob;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(Product $product, ProductService $productService, CreateProduct $createProduct)
    {
        $this->product = $product;
        $this->productService = $productService;
        $this->createProduct = $createProduct;
    }

    public function store(Shelf $shelf)
    {
        /*
        |--------------------------------------------------------------------------
        | Basic Stuff
        |--------------------------------------------------------------------------
        */
        $code = 'PRD1234';
        if ($shelf->products()->where('code', $code)->exists()) {
            return response()->json(['error' => 'Product with this code already exist'], 422);
        }

        $product = $this->product->create([
            'code' => $code,
            'name' => 'Pisang'
        ]);

        $product->update([
            'shelf_id' => $shelf->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | Example With Model
        |--------------------------------------------------------------------------
        */
        // try {
        //     $product = $this->product->createProduct($shelf);
        // } catch (\Exception $exception) {
        //     return response()->json(['error' => $exception->getMessage()], 422);
        // }

        /*
        |--------------------------------------------------------------------------
        | Example With Service
        |--------------------------------------------------------------------------
        */
        // try {
        //     $product = $this->productService->createProduct($shelf);
        // } catch (\Exception $exception) {
        //     return response()->json(['error' => $exception->getMessage()], 422);
        // }

        /*
        |--------------------------------------------------------------------------
        | Example With Action
        |--------------------------------------------------------------------------
        */
        // try {
        //     $product = $this->createProduct->handle($shelf);
        // } catch (\Exception $exception) {
        //     return response()->json(['error' => $exception->getMessage()], 422);
        // }

        /*
        |--------------------------------------------------------------------------
        | Example With Job
        |--------------------------------------------------------------------------
        */
        // try {
        //     dispatch(new createProductJob($shelf));
        // } catch (\Exception $exception) {
        //     return response()->json(['error' => $exception->getMessage()], 422);
        // }
        return response()->json(['product' => $product], 200);
    }
}