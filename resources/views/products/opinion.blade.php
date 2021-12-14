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
        <a href={{ route('products.show', $product) }}>Информация</a>
        <a href={{ route('products.opinion', $product) }}>Отзывы</a>
        <a href={{ route('products.review', $product) }}>Обзоры</a>
    </p>
    <div>
        <h2>Отзывы</h2>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, reiciendis vel! Maiores et officia quas ullam perspiciatis, blanditiis atque? Aperiam provident, ratione non similique eos aut sint dolores corporis quidem!
    </div>
</x-layout>
