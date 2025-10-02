<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Product $product)
    {
        $this->cartService->addToCart($product);
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function update(Request $request, Product $product)
    {
        $this->cartService->updateQuantity($product->id, $request->quantity);
        return redirect()->back()->with('success', 'Корзина обновлена!');
    }

    public function remove(Product $product)
    {
        $this->cartService->removeFromCart($product->id);
        return redirect()->back()->with('success', 'Товар удален из корзины!');
    }
}