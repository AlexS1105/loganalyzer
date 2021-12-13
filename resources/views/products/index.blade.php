<x-layout>
    <h1>Товары</h1>
    <p>
        <a href="{{ route('index') }}">Назад</a>
    </p>
    @forelse ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @empty
        Список товаров пуст!
    @endforelse
</x-layout>
