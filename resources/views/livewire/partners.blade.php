<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Партнеры</h2>

    <div>
        <h3 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Редактирование партнера' : 'Добавление нового партнера' }}</h3>
        <form wire:submit.prevent="{{ $isEditing ? 'updatePartner' : 'createPartner' }}" class="grid grid-cols-2 gap-4">
            <input type="text" wire:model="name" placeholder="Имя" class="border rounded p-2">
            <input type="email" wire:model="email" placeholder="Email" class="border rounded p-2">
            <input type="text" wire:model="phone" placeholder="Телефон" class="border rounded p-2">
            <textarea wire:model="description" placeholder="Описание" class="border rounded p-2 col-span-2"></textarea>
            <select wire:model="status" class="border rounded p-2">
                <option value="сотрудничаем" selected>Сотрудничаем</option>
                <option value="прекратили сотрудничество">Прекратили сотрудничество</option>
            </select>
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
                <th class="border p-2">Телефон</th>
                <th class="border p-2">Описание</th>
                <th class="border p-2">Статус</th>
                <th class="border p-2">Дата сотрудничества</th>
                <th class="border p-2">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($partners as $partner)
                <tr class="border">
                    <td class="p-2">{{ $partner->name }}</td>
                    <td class="p-2">{{ $partner->email }}</td>
                    <td class="p-2">{{ $partner->phone }}</td>
                    <td class="p-2">{{ $partner->description }}</td>
                    <td class="p-2">

                        @if ($partner->status === 'сотрудничаем')
                            <span>Сотрудничаем</span>
                        @elseif ($partner->status === 'прекратили сотрудничество')
                            <span>Прекратили сотрудничество</span>
                        @endif
                    </td>
                    <td class="p-2">
                        @if ($partner->date_of_cooperation)
                            {{ $partner->date_of_cooperation->format('d.m.Y H:i') }}
                        @else
                            Нет даты
                        @endif
                    </td>
                    <td class="p-2 flex space-x-2">
                        <button wire:click="editPartner({{ $partner->id }})">✏️</button>
                        <button wire:click="deletePartner({{ $partner->id }})">🗑️</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
