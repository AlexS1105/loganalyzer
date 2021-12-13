<x-layout>
    <div>
        Название: {{ $product->name }}
    </div>
    <div>
        Описание: {{ $product->description }}
    </div>
    <form method="POST" action="{{ route('products.buy', $product) }}">
        @csrf
        <button type="submit">Купить</button>
        <div>{{ session('status') }}</div>
    </form>
    <p>
        <a href={{ route('products.index') }}>Назад</a>
    </p>
</x-layout>
