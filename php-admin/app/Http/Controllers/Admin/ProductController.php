<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Список товаров
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Форма создания
    public function create()
    {
        return view('admin.products.create');
    }

    // Сохранение нового товара
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно создан');
    }

    // Просмотр одного товара
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Форма редактирования
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Обновление товара
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно обновлен');
    }

    // Удаление товара
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален');
    }
}