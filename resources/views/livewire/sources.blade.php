<div class="max-w-6xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Источники</h2>

    <div>
        <h3 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Редактирование источника' : 'Добавление нового источника' }}</h3>
        <form wire:submit.prevent="{{ $isEditing ? 'updateSource' : 'createSource' }}" class="grid grid-cols-2 gap-4">
            <select wire:model="type" class="border rounded p-2">
                <option value="соцсети">Соцсети</option>
                <option value="рекомендация знакомых">Рекомендация знакомых</option>
                <option value="поиск в браузере">Поиск в браузере</option>
                <option value="наружная реклама">Наружная реклама</option>
                <option value="СМИ или блогеры">СМИ или блогеры</option>
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
                <th class="border p-2">Тип</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sources as $source)
                <tr class="border">
                    <td class="p-2">
                        @if ($source->type === 'cоцсети')
                            <span>Соцсети</span>
                        @elseif ($source->type === 'рекомендация знакомых')
                            <span>Рекомендация знакомых</span>
                        @elseif ($source->type === 'поиск в браузере')
                            <span>Поиск в браузере</span>
                        @elseif ($source->type === 'наружная реклама')
                            <span>Наружная реклама</span>
                        @elseif ($source->type === 'СМИ или блогеры')
                            <span>СМИ или блогеры</span>
                        @endif
                    </td>
                    <td class="p-2 flex space-x-2">
                        <button wire:click="editSource({{ $source->id }})">✏️</button>
                        <button wire:click="deleteSource({{ $source->id }})">🗑️</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
