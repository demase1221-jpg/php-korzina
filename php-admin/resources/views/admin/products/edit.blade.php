@extends('admin.layout')

@section('content')
<h1>Редактировать товар</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Название</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Цена</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Остаток на складе</label>
        <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Обновить</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Отмена</a>
</form>
@endsection