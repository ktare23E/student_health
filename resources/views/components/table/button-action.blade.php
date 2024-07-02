@php
    $class = 'px-2 py-1 text-white font-bold rounded-sm';
    //check the button text
    if ($slot == 'edit') {
        $class .= ' bg-orange-500 text-sm font-normal';
    } elseif ($slot == 'view') {
        $class .= ' bg-yellow-500 text-sm font-normal';
    }elseif($slot == 'Create'){
        $class .= ' bg-blue-600 ';
    }

@endphp

<a {{$attributes(['class' => $class])}}>{{$slot}}</a>
