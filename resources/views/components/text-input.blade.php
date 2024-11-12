@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm']) }}>
