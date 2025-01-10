<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleting(Product $product): void
    {
        DB::transaction(function () use ($product) {
            $orders = $product->orders()->withPivot('quantity', 'unit_price')->get();

            foreach ($orders as $order) {
                $quantity = $order->pivot->quantity;
                $unitPrice = $order->pivot->unit_price;
                $amountToDeduct = $quantity * $unitPrice;

                $order->total_price = max(0, $order->total_price - $amountToDeduct);
                $order->save();

                $order->products()->detach($product->id);
            }
        });
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
