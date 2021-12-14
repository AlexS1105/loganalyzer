<x-layout>
    <div class="m-auto text-center space-y-4 max-w-md">
        <div class="bg-white p-4 rounded-xl space-y-4">
            <div class="text-4xl">
                {{ $product->name }}
            </div>
            <div class="text-normal">
                {{ $product->description }}
            </div>
        </div>
        <div class="flex justify-between">
            <a class="uppercase text-lg bg-white px-4 py-2 font-semibold rounded-full" href={{ route('products.show', $product) }}>Информация</a>
            <a class="uppercase text-lg bg-white px-4 py-2 font-semibold rounded-full" href={{ route('products.opinion', $product) }}>Отзывы</a>
            <a class="uppercase text-lg bg-white px-4 py-2 font-semibold rounded-full" href={{ route('products.review', $product) }}>Обзоры</a>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4">
            <h1 class="text-2xl mr-auto font-semibold">Отзывы</h1>
            <div class="max-w-max">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit facere explicabo iure eveniet animi ducimus esse eligendi, expedita error officia aperiam, ipsa alias cum harum dicta sequi vero. Ratione, blanditiis.
            </div>
        </div>
        <form method="POST" action="{{ route('products.buy', $product) }}">
            @csrf
            <button class="w-full uppercase text-lg bg-white px-4 py-2 font-semibold rounded-full" type="submit">Купить</button>
            <div>{{ session('status') }}</div>
        </form>
        <p class="text-lg mt-8 uppercase">
            <a href="{{ route('products.index') }}">Назад</a>
        </p>
    </div>
</x-layout>
