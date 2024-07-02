<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet" />

    <div class="bg-blue-100 min-h-screen">
        <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
            <div class="flex items-center justify-between py-2 text-5x1">
                <div class="font-bold text-blue-900 text-xl">Admin<span class="text-orange-600">Panel</span></div>
                <div class="flex items-center text-gray-500">
                    <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2"
                    style="background-image: url('{{ asset('imgs/deped_logo.png') }}');">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')

            <div class="w-10/12">
                <div class="flex flex-row">
                    <h1>Division List</h1>
                    <button class="click">Click me</button>
                </div>
                <div class="flex flex-row h-64 mt-6">
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
                        a
                    </div>
                    <div class="bg-white rounded-xl shadow-lg mx-6 px-6 py-4 w-4/12">
                        b
                    </div>
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
                        c
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
