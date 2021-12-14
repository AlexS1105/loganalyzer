<x-layout>
    <div class="m-auto text-center">
        <h1 class="text-4xl mb-8 uppercase">Товары</h1>
        <div class="grid grid-cols-4 gap-4 text-lg font-semibold">
            @forelse ($products as $product)
                <div class="bg-white rounded-xl p-2">
                    <a href="{{ route('reports.products.show', $product) }}">{{ $product->name }}</a>
                </div>
            @empty
                Список товаров пуст!
            @endforelse
        </div>
        <p class="text-lg mt-8 uppercase">
            <a href="{{ route('reports.index') }}">Назад</a>
        </p>
    </div>
</x-layout>
