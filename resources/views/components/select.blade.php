@props([
    'options' => [],
    'name',
    'id' => null,
    'selected' => old($name) // fallback ke input lama jika validasi gagal
])

<select
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    {{ $attributes->merge(['class' => 'w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white']) }}
>
    <option value="">-- Select --</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ (string)$selected === (string)$value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
