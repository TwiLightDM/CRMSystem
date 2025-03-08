<div>
    <h1>Пользователи</h1>
    <p>Количество юзеров: {{$usersCount}}</p>
    @forelse($users as $user)
        <div>
            <h2>{{$user->name}}</h2>
        </div>
    @empty
        <p>Ничего не найдено</p>
    @endforelse
</div>
