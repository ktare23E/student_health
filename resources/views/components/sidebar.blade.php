<div class="w-2/12 mr-6">
    @if (auth()->user()->role == 'admin')
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 space-y-4">
            <x-dynamic-link href="{{ route('admin.index') }}" is-active="admin_dashboard" icon="dashboard"
                text="Dashboard" />
            <x-dynamic-link href="{{ route('admin.division') }}" is-active="division" icon="apartment" text="Division" />
            <x-dynamic-link href="{{ route('admin.district') }}" is-active="district" icon="domain" text="District" />
            <x-dynamic-link href="{{ route('admin.school') }}" is-active="school" icon="domain" text="School" />
            <x-dynamic-link href="{{ route('admin_nurse') }}" is-active="admin_nurse" icon="medication"
                text="Nurse" />
            <x-dynamic-link href="{{ route('archive_nurse') }}" is-active="archive_nurse" icon="archive"
                text="Archive" />
            <x-dynamic-link href="{{ route('system_logs') }}" is-active="system_logs" icon="archive"
                text="System Logs" />
        </div>
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 h-24">
            {{-- <a href="{{route('district_profile')}}" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">face</span>
                Profile
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </a> --}}
            <button type="submit" form="logout"
                class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black  w-full py-4 rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">power_settings_new</span>
                Log out
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </button>

            <x-forms.form method="POST" action="{{ route('admin_logout') }}" id="logout">

            </x-forms.form>
        </div>
    @endif
    @if (auth()->user()->type == 'school')
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 space-y-4">
            <x-dynamic-link href="{{ route('nurse_dashboard') }}" is-active="nurse_dashboard" icon="dashboard"
                text="Dashboard" />
            <x-dynamic-link href="{{ route('student_list') }}" is-active="student_list" icon="group" text="Student" />
            <x-dynamic-link href="{{ route('school.archive_student') }}" is-active="archive_student" icon="archive"
                text="Archive" />
            <x-dynamic-link href="{{ route('report') }}" is-active="report" icon="summarize" text="Report" />
        </div>
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">

            <a href="{{ route('school_profile') }}"
                class="{{ request()->is('school_profile') ? 'bg-blue-200' : '' }} inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">face</span>
                Profile
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </a>
            <button type="submit" form="logout"
                class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">power_settings_new</span>
                Log out
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </button>

            <x-forms.form method="POST" action="{{ route('logout') }}" id="logout">

            </x-forms.form>
        </div>
    @endif
    @if (auth()->user()->type == 'district')
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 space-y-4">
            <x-dynamic-link href="{{ route('district_nurse_dashboard') }}" is-active="district_nurse_dashboard"
                icon="dashboard" text="Dashboard" />
            <x-dynamic-link href="{{ route('school_list') }}" is-active="school_list" icon="domain" text="School" />

            <x-dynamic-link href="{{ route('district_report') }}" is-active="district_report" icon="summarize"
                text="Report" />

        </div>
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
            <a href="{{ route('district_profile') }}"
                class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">face</span>
                Profile
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </a>
            <button type="submit" form="logout"
                class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">power_settings_new</span>
                Log out
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </button>

            <x-forms.form method="POST" action="{{ route('logout') }}" id="logout">

            </x-forms.form>
        </div>
    @endif
    @if (auth()->user()->type == 'division')
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 space-y-4">
            <x-dynamic-link href="{{ route('division_nurse_dashboard') }}" is-active="division_nurse_dashboard"
                icon="dashboard" text="Dashboard" />

            <x-dynamic-link href="{{ route('division_school_list') }}" is-active="division_school_list"
                icon="domain" text="School" />

            <x-dynamic-link href="{{ route('division_report') }}" is-active="division_report" icon="summarize"
                text="Report" />
        </div>
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
            <a href="{{ route('division_profile') }}"
                class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">face</span>
                Profile
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </a>
            <button type="submit" form="logout"
                class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">power_settings_new</span>
                Log out
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </button>

            <x-forms.form method="POST" action="{{ route('logout') }}" id="logout">

            </x-forms.form>
        </div>
    @endif




</div>
