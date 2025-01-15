<a href="{{$href}}" class="{{request()->is($isActive) ? 'bg-blue-200' : ''}}  inline-block text-gray-600 hover:text-black py-2 px-2 w-full">
    <span class="material-icons-outlined float-left pr-2">{{$icon}}</span>
    {{$text}}
    <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
</a>