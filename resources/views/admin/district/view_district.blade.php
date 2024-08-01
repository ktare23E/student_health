<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            <div class="w-10/12 flex flex-col mx-auto">
                <div>

                    <nav class="bg-white p-4 rounded-md shadow-md w-full font-bold">
                        <ol class="list-reset flex text-gray-700">
                            <li>
                                <a href="{{route('admin.index')}}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="{{route('admin.division')}}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">Division</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">District</a>
                            </li>
                        </ol>
                        
                    </nav>

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">District List under of {{$division->name}}</h1>
                            <!-- Student Details -->
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>District Name</th>
                                        <th>Address</th>
                                        <th>District Head</th>
                                        <th>Nurse Assigned</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($districts as $district)
                                        <tr>
                                            <td class="data1">{{ $district->name }}</td>
                                            <td class="data2">{{ $district->address }}</td>
                                            <td class="data2">{{ $district->district_head }}</td>
                                            @if ($district->nurses->count() === 0)
                                                <td>
                                                    No District Nurse Yet
                                                </td>
                                            @else
                                                <td>{{$district->nurses->first()->last_name.' '.$district->nurses->first()->first_name}}</td>
                                            @endif
                                            <td>
                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                    <a href="{{route('district_view_school_list',$district->id)}}">view school</a>   
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
        
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
