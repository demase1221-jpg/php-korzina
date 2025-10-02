<div class="container">
    <h1>Корзина</h1>

    @if($cartItems->count() > 0)
        @foreach($cartItems as $item)
        <div class="cart-item">
            <h5>{{ $item->product->name }}</h5>
            <p>Цена: {{ $item->price }} ₽</p>
            <form action="{{ route('cart.update', $item->product) }}" method="POST">
                @csrf @method('PUT')
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                <button type="submit">Обновить</button>
            </form>
            <p>Сумма: {{ $item->total }} ₽</p>
            <form action="{{ route('cart.remove', $item->product) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
        @endforeach

        <div class="cart-total">
            <h4>Общая сумма: {{ $total }} ₽</h4>
        </div>
    @else
        <p>Корзина пуста</p>
    @endif
</div>