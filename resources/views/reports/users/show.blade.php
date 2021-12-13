<x-layout>
    <p>
        <a href={{ route('reports.users.index') }}>Назад</a>
    </p>
    <div>
        Имя: {{ $user->name }}
    </div>
</x-layout>
