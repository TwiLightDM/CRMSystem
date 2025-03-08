<div>
    <h1>Пользователи {{$usersCount}}</h1>
    @forelse($users as $user)
        <div>
            <h2>Юзер: </h2>{{$user->name}}
            <h2>Дата удаления: </h2>{{$user->deleted_at??'Нет'}}
        </div>
    @empty
        <p>Ничего не найдено</p>
    @endforelse
</div>
