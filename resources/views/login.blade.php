<x-layout>
    <head>
        {{-- <!-- Include Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    </head>
    <div class="flex items-center justify-center">
        <div class="h-screen bg-gradient-to-br from-blue-600 to-cyan-300 flex justify-center items-center w-full">
            <x-forms.form method='POST' action="{{ route('login.store') }}">
                <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-xl max-w-sm">
                    <div class="">
                        <div>
                            <img src="{{ asset('imgs/deped_logo.png') }}" alt="logo" class="w-20 h-20 mx-auto">
                        </div>
                        <h1 class="text-center text-md font-semibold text-gray-600 mb-5">Student Health Information Management System</h1>
                        <hr>
                        <div class="flex items-center border-2 py-2 px-3 rounded-md mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                            <input class="pl-2 outline-none border-none w-full" type="email" name="email" value="" placeholder="Email" required/>
                        </div>
                        @error('email')
                            <div class="text-red-500 text-sm">{{$message}}</div>
                        @enderror
                        <div class="flex items-center border-2 py-2 px-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            <input class="pl-2 outline-none border-none w-full" type="password" name="password" id="password" placeholder="Password" required/>
                            <span class="material-icons cursor-pointer text-gray-600 text-md" id="togglePassword">visibility</span>
                        </div>
                        @error('password')
                            <div class="text-red-500 text-sm">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" value="login" id="login" class="mt-6 w-full shadow-xl bg-gradient-to-tr from-blue-600 to-red-400 hover:to-red-700 text-indigo-100 py-2 rounded-md text-lg tracking-wide transition duration-1000">Login</button>
                    <hr>
                </div>
            </x-forms.form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the icon
            this.textContent = this.textContent === 'visibility' ? 'visibility_off' : 'visibility';
        });
    </script>
</x-layout>
