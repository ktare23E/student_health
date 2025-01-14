@php
    $class = 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap';
@endphp

<td scope="row" {{$attributes(['class' => $class])}}>
    {{$slot}}
</td>