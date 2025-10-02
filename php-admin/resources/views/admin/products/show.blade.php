@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Просмотр товара</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Назад</a>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text"><strong>Описание:</strong> {{ $product->description ?? 'Нет описания' }}</p>
        <p class="card-text"><strong>Цена:</strong> {{ $product->price }} ₽</p>
        <p class="card-text"><strong>Остаток:</strong> {{ $product->stock }}</p>
        <p class="card-text"><strong>Создан:</strong> {{ $product->created_at }}</p>
        <p class="card-text"><strong>Обновлен:</strong> {{ $product->updated_at }}</p>
        
        <div class="mt-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Редактировать</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
            </form>
        </div>
    </div>
</div>
@endsection