<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderItem::class;
    public function definition(): array
    {
        $product = Product::where('amount', '>', 0)->inRandomOrder()->first();
        $order = Order::inRandomOrder()->first();

        $amount = $this->faker->numberBetween(1, $product->amount);
        $total_price = $product->price * $amount;

        $product->amount -= $amount;
        $product->save();

        $order->price_total += $total_price;
        $order->save();
        return [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'amount' => $amount
        ];
    }
}
