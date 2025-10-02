@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Товары</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Добавить товар</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Остаток</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }} ₽</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection