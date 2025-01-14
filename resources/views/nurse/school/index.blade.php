<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">School List</h1>
                    </div>
                    
                    
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr class="text-sm">
                                            <td>{{ $school->name }}</td>
                                            <td>{{ $school->address}}</td>
                                            <td>{{ $school->district->name }}</td>
                                            <td class="capitalize text-green-500 text-sm">{{ $school->status }}</td>
                                            <td>
                                                @if (auth()->user()->type === 'district')
                                                    <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                        <a href="{{route('view_school',$school->id)}}">view</a>   
                                                    </button>
                                                @else
                                                    <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                        <a href="{{route('division_view_school',$school->id)}}">view</a>   
                                                    </button>
                                                @endif
                                                
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
        @include('components.modal.student_modal')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
        
    </script>
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</x-layout>
