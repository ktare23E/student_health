<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            <div class="w-10/12 flex flex-col mx-auto">
                <div>

                    <nav class="bg-white p-4 rounded-md shadow-md w-full font-bold">
                        <ol class="list-reset flex text-gray-700">
                            @if (auth()->user()->type == 'school')
                                <li>
                                    <a href="{{ route('nurse_dashboard') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Nurse
                                        Profile</a>
                                </li>
                            @elseif (auth()->user()->type == 'district')
                                <li>
                                    <a href="{{ route('district_nurse_dashboard') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Nurse
                                        Profile</a>
                                </li>
                            @endif
                        </ol>
                    </nav>

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <div class="flex justify-between items-center">
                                <h1 class="font-semibold text-md mb-4">Nurse Profile</h1>
                                <div>
                                    {{-- <button class="oepn-modal py-3 px-4 text-sm bg-blue-500 rounded-sm text-white" data-modal="modal1">Change Password</button> --}}
                                    <button data-modal="modal1"
                                        class="open-modal bg-blue-500 text-sm text-white px-4 py-2 rounded m-2">Change
                                        Password</button>
                                </div>
                            </div>

                            <!-- Profile Image -->
                            <div class="flex justify-center mb-4">
                                <img src="{{ asset('imgs/default_profile.jpg') }}" alt="Profile Image"
                                    class="w-48 h-48 rounded-full object-cover">
                            </div>

                            <!-- Student Details -->
                            <div class="w-[70%] mx-auto grid grid-cols-3 gap-x-4 gap-y-4">
                                <!-- Name -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Name:</p>
                                    <p class="text-center">{{ $nurse->first_name . ' ' . $nurse->last_name }}</p>
                                </div>

                                <!-- Address -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Address:</p>
                                    <p class="text-center">{{ $nurse->address }}</p>
                                </div>

                                <!-- Status -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Status:</p>
                                    <p
                                        class="text-center capitalize {{ $nurse->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $nurse->status }}</p>
                                </div>

                                <!-- Grade Level -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Nurse Type:</p>
                                    <p class="text-center">
                                        {{ ($nurse->type === 'district' ? 'District Nurse' : $nurse->type === 'school') ? 'School Nurse' : 'Division Nurse' }}
                                    </p>
                                </div>

                                <!-- School -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Assigned to:</p>
                                    @if (auth()->user()->type === 'district')
                                        <p class="text-center">{{ $district->name }}</p>
                                    @elseif (auth()->user()->type === 'school')
                                        <p class="text-center">{{ $school->name }}</p>
                                    @else
                                        <p class="text-center">{{ $division->name }}</p>
                                    @endif
                                </div>

                                <!-- School Address -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Entity Address:</p>
                                    @if (auth()->user()->type === 'district')
                                        <p class="text-center">{{ $district->address }}</p>
                                    @elseif (auth()->user()->type === 'school')
                                        <p class="text-center">{{ $school->address }}</p>
                                    @else
                                        <p class="text-center">{{ $division->address }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('components.modal.change_password')
    </div>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                icon.textContent = 'visibility';
            }
        });

        $('.change_password').click(function(){
            var password = $('#password').val();
            var id = {{ $nurse->id }};
            var route = '{{ $nurse->type === 'district' ? route('district_change_password') : ($nurse->type === 'school' ? route('school_change_password') : route('division_change_password')) }}';


            $.ajax({
                url: route,
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'password': password,
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    if (data.message === 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sucessfully Updated Password",
                            icon: "success"
                        }).then(function(){
                            location.reload();
                        });
                    }
                }
            });
        
        })
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
