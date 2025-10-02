<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCartItems()
    {
        if (!Auth::check()) return collect();
        
        return CartItem::with('product')->where('user_id', Auth::id())->get();
    }

    public function addToCart(Product $product, $quantity = 1)
    {
        if (!Auth::check()) return false;

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return true;
    }

    public function updateQuantity($productId, $quantity)
    {
        if (!Auth::check()) return false;

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            if ($quantity <= 0) {
                $cartItem->delete();
            } else {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            return true;
        }

        return false;
    }

    public function removeFromCart($productId)
    {
        if (!Auth::check()) return false;

        return CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();
    }

    public function getTotal()
    {
        return $this->getCartItems()->sum('total');
    }

    public function getTotalQuantity()
    {
        return $this->getCartItems()->sum('quantity');
    }
}