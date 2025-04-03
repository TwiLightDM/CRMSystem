<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Юзеры</h2>

    <div>
        <h3 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Редактирование лида' : 'Добавление нового лида' }}</h3>
        <form wire:submit.prevent="{{ $isEditing ? 'updateUser' : 'createUser' }}" class="grid grid-cols-2 gap-4">
            <input type="text" wire:model="name" placeholder="Имя" class="border rounded p-2">
            <input type="email" wire:model="email" placeholder="Email" class="border rounded p-2">
            <input type="text" wire:model="password" placeholder="Пароль" class="border rounded p-2">
            <button type="submit">{{ $isEditing ? 'Обновить' : 'Добавить' }}</button>
            @if ($isEditing)
                <button type="button" wire:click="resetFields">Отмена</button>
            @endif
        </form>
    </div>

    <div>
        <table>
            <thead>
            <tr>
                <th class="border p-2">Имя</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Пароль</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->password }}</td>
                    <td class="p-2 flex space-x-2">
                        <button wire:click="editUser({{ $user->id }})">✏️</button>
                        <button wire:click="deleteUser({{ $user->id }})">🗑️</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
