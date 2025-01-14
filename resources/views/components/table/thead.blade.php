@php
    
    $class = 'px-6 py-3';
@endphp

<th scope="col" {{$attributes(['class' => $class])}}>
    {{$slot}}
</th>