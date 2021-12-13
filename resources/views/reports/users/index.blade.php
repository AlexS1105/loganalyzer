<x-layout>
    <h1>Пользователи</h1>
    <p>
        <a href="{{ route('reports.index') }}">Назад</a>
    </p>
    @forelse ($users as $user)
        <div>
            <a href="{{ route('reports.users.show', $user) }}">{{ $user->name }}</a>
        </div>
    @empty
        Список товаров пуст!
    @endforelse
</x-layout>
