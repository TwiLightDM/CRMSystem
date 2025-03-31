<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Лиды</h2>

    <div>
        <h3 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Редактирование лида' : 'Добавление нового лида' }}</h3>
        <form wire:submit.prevent="{{ $isEditing ? 'updateLead' : 'createLead' }}" class="grid grid-cols-2 gap-4">
            <input type="text" wire:model="name" placeholder="Имя" class="border rounded p-2">
            <input type="email" wire:model="email" placeholder="Email" class="border rounded p-2">
            <input type="text" wire:model="phone" placeholder="Телефон" class="border rounded p-2">
            <textarea wire:model="description" placeholder="Описание" class="border rounded p-2 col-span-2"></textarea>
            <select wire:model="status" class="border rounded p-2">
                <option value="не обработан">Не обработан</option>
                <option value="в работе">В работе</option>
                <option value="ликвидный">Ликвидный</option>
                <option value="бракованный">Бракованный</option>
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
                <th class="border p-2">Ответственный</th>
                <th class="border p-2">Дата создания</th>
                <th class="border p-2">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leads as $lead)
                <tr class="border">
                    <td class="p-2">{{ $lead->name }}</td>
                    <td class="p-2">{{ $lead->email }}</td>
                    <td class="p-2">{{ $lead->phone }}</td>
                    <td class="p-2">{{ $lead->description }}</td>
                    <td class="p-2">
                        @if ($lead->status === 'не обработан')
                            <span>Не обработан</span>
                        @elseif ($lead->status === 'в работе')
                            <span>В работе</span>
                        @elseif ($lead->status === 'ликвидный')
                            <span>Ликвидный</span>
                        @elseif ($lead->status === 'бракованный')
                            <span>Бракованный</span>
                        @endif
                    </td>
                    <td class="p-2">{{ $lead->nominated_person }}</td>
                    <td class="p-2">
                        @if ($lead->date_of_creation)
                            {{ $lead->date_of_creation->format('d.m.Y H:i') }}
                        @else
                            Нет даты
                        @endif
                    </td>
                    <td class="p-2 flex space-x-2">
                        <button wire:click="editLead({{ $lead->id }})">✏️</button>
                        <button wire:click="deleteLead({{ $lead->id }})">🗑️</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
