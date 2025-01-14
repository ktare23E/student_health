<div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
    <div class="flex items-center justify-between py-2 text-5x1">
        @if(auth()->user()->role == 'admin')
            <div class="font-bold text-blue-900 text-xl">Admin<span class="text-orange-600">Panel</span></div>
        @elseif(auth()->user()->type == 'school')
            <div class="font-bold text-blue-900 text-xl">School Nurse<span class="text-orange-600">Panel</span></div>
        @elseif(auth()->user()->type == 'district')
            <div class="font-bold text-blue-900 text-xl">District Nurse<span class="text-orange-600">Panel</span></div>
        @elseif(auth()->user()->type == 'division')
        <div class="font-bold text-blue-900 text-xl">Division Nurse<span class="text-orange-600">Panel</span></div>
        @endif
        <div class="flex items-center text-gray-500">
            <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2 border-4"
                style="background-image: url('{{ asset('imgs/deped_logo.png') }}');">
            </div>
        </div>
    </div>
</div>