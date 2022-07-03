<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class createProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $shelf;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($shelf)
    {
        $this->shelf = $shelf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $code = 'PRD1234';
        if ($this->shelf->products()->where('code', $code)->exists()) {
            throw new \Exception('Product with this code already exist');
        }

        $product = Product::create([
            'code' => $code,
            'name' => 'Pisang'
        ]);

        $product->updateShelf($this->shelf->id);

        return $product;
    }
}
