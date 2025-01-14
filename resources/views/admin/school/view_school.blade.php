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
                                <a href="{{route('view_district',$district->division_id)}}" class="text-blue-600 hover:text-blue-800 hover:underline">District</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">School</a>
                            </li>
                        </ol>
                        
                    </nav>

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">School List under of {{$district->name}}</h1>
                            <!-- Student Details -->
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Principal</th>
                                        <th>Nurse Assigned</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr class="text-sm">
                                            <td>{{ $school->name }}</td>
                                            <td>{{ $school->address}}</td>
                                            <td>{{ $school->district->name }}</td>
                                            <td class="capitalize ">{{ $school->principal }}</td>
                                            @if($school->nurses->count() === 0)
                                                <td>No Nurse Assigned</td>
                                            @else
                                                <td>{{$school->nurses->first()->last_name.' '.$school->nurses->first()->first_name}}</td>
                                            @endif
                                            {{-- <td>
                                         
                                                
                                            </td> --}}
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
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</x-layout>
