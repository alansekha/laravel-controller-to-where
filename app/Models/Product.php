<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function updateShelf(int $shelf_id): void
    {
        $this->update(['shelf_id' => $shelf_id]);
    }

    public function createProduct($shelf): Product
    {
        $code = 'PRD1234';
        if ($shelf->products()->where('code', $code)->exists()) {
            throw new \Exception('Product with this code already exist');
        }

        $product = $this->create([
            'code' => $code,
            'name' => 'Pisang'
        ]);

        $this->updateShelf($shelf->id);

        return $product;
    }
}
