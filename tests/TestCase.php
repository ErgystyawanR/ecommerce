<?php

namespace Tests;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function test_checkout_with_valid_data()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a product
        $product = Product::factory()->create();

        // Login as the user
        $this->actingAs($user);

        // Add the product to cart
        $response = $this->post(route('add_to_cart', $product), ['amount' => 1]);
        $response->assertRedirect();

        // Get the user's cart
        $cart = $user->cart;

        // Proceed to checkout
        $response = $this->post(route('checkout'), ['cart_id' => $cart->id]);
        $response->assertRedirect(); // Assuming the checkout redirects to a success page

        // Check if the order is created
        $this->assertNotNull(Order::where('user_id', $user->id)->first());
    }

    /**
     * Test checkout process with invalid data.
     *
     * @return void
     */
    public function test_checkout_with_invalid_data()
    {
        // Create a user
        $user = User::factory()->create();

        // Login as the user
        $this->actingAs($user);

        // Attempt to checkout without adding anything to the cart
        $response = $this->post(route('checkout'), ['cart_id' => null]);
        $response->assertRedirect(); // Assuming the checkout redirects back to the cart page with an error message
        $this->assertNull(Order::where('user_id', $user->id)->first()); // Ensure no order is created
    }
}
