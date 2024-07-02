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
            @include('components.modal.modal_test')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">Division List</h1>
                        <button data-modal="modal1" class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Open Modal 1</button>
                        <button data-modal="modal2" class="open-modal bg-green-500 text-white px-4 py-2 rounded m-2">Open Modal 2</button>
                    </div>
                    <div class="flex flex-row p-[2rem] mt-2 w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-[50%] mx-auto">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Column 1</th>
                                        <th>Column 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Row 1 Data 1</td>
                                        <td>Row 1 Data 2</td>
                                    </tr>
                                    <tr>
                                        <td>Row 2 Data 1</td>
                                        <td>Row 2 Data 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">Division List</h1>
                    </div>
                    <div class="flex flex-row p-[2rem] mt-2 w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-[50%] mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Column 1</th>
                                        <th>Column 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Row 1 Data 1</td>
                                        <td>Row 1 Data 2</td>
                                    </tr>
                                    <tr>
                                        <td>Row 2 Data 1</td>
                                        <td>Row 2 Data 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
            $('#myTable2').DataTable();
        } );
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
