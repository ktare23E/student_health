<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">System Log List</h1>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Nurse Name</th>
                                        <th>Nurse Type</th>
                                        <th>Assigned To</th>
                                        <th>Date Accessed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td class="data1">{{ $log->nurse->first_name.' '.$log->nurse->last_name }}</td>
                                            <td>{{$log->nurse->type === 'school' ? 'School Nurse' : ($log->nurse->type === 'district' ? 'District Nurse':'Division Nurse')}}</td>
                                            <td>{{$log->nurse->assigned_entity->name}}</td>
                                            <td class="data2">{{ \Carbon\Carbon::parse($log->date)->format('F j, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.modal.modal_test')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
