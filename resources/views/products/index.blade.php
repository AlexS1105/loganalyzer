<x-layout>
    @forelse ($products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </div>
    @empty
        Список товаров пуст!
    @endforelse
</x-layout>
