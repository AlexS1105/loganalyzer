<x-layout>
    <h1>Товары</h1>
    <p>
        <a href="{{ route('reports.index') }}">Назад</a>
    </p>
    @forelse ($products as $product)
        <div>
            <a href="{{ route('reports.products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @empty
        Список товаров пуст!
    @endforelse
</x-layout>
