<x-layout>
    <div class="m-auto">
        <h1 class="text-4xl mb-8 uppercase text-center">Отчеты</h1>
        <div class="flex text-3xl space-x-16 font-semibold uppercase">
            <div class="bg-white rounded-full p-4">
                <a href="{{ route('reports.users.index') }}">Выборка по пользователям</a>
            </div>
            <div class="bg-white rounded-full p-4">
                <a href="{{ route('reports.products.index') }}">Выборка по товарам</a>
            </div>
        </div>
        <p class="text-lg mt-8 uppercase text-center">
            <a href="{{ route('index') }}">Назад</a>
        </p>
    </div>
</x-layout>
