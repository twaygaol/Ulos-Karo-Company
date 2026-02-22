<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\orderItem;
use App\Models\product;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function afterCreate(): void
    {
        $order = $this->record;

        $items = request()->input('items', []);

        $total = 0;

        foreach ($items as $item) {
            $product = product::find($item['product_id']);

            $price = $product->price;
            $subtotal = $price * $item['quantity'];

            orderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $price,
            ]);

            $total += $subtotal;
        }

        $order->update([
            'total_price' => $total
        ]);
    }
}
