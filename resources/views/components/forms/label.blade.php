@props(['name', 'label'])

<div class="inline-flex items-center gap-x-2">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="{{ $name }}">{{ $label }}</label>
</div>