<div class="w-2/12 mr-6">
    @if (auth()->user()->role == 'admin')
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 space-y-4">
            <x-dynamic-link
                href="{{route('admin.index')}}"
                is-active="admin_dashboard"
                icon="dashboard"
                text="Dashboard"
            />
            <x-dynamic-link
                href="{{route('admin.division')}}"
                is-active="division"
                icon="apartment"
                text="Division"
            />
            <x-dynamic-link
                href="{{route('admin.district')}}"
                is-active="district"
                icon="domain"
                text="District"
            />
            <x-dynamic-link
                href="{{route('admin.school')}}"
                is-active="school"
                icon="domain"
                text="School"
            />
            <x-dynamic-link
                href="{{route('admin_nurse')}}"
                is-active="admin_nurse"
                icon="medication"
                text="Nurse"
            />
            <x-dynamic-link
                href="{{route('archive_nurse')}}"
                is-active="archive_nurse"
                icon="archive"
                text="Archive"
            />
            <x-dynamic-link
                href="{{route('system_logs')}}"
                is-active="system_logs"
                icon="archive"
                text="System Logs"
            />
        </div>
        <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4 h-24">
            {{-- <a href="{{route('district_profile')}}" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">face</span>
                Profile
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </a> --}}
            <button type="submit" form="logout" class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black  w-full py-4 rounded-md transition ease-in-out duration-150">
                <span class="material-icons-outlined mr-2">power_settings_new</span>
                Log out
                <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
            </button>
            
            <x-forms.form method="POST" action="{{route('logout')}}" id="logout">
                
            </x-forms.form>
        </div>
    @endif
    @if (auth()->user()->type == 'school')
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('nurse_dashboard')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">dashboard</span>
            Dashboard
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('student_list')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">group</span>
            Student
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('school.archive_student')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">archive</span>
            Archive Student
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('report')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">summarize</span>
            Report
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('school_profile')}}" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">face</span>
            Profile
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </a>
        <button type="submit" form="logout" class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">power_settings_new</span>
            Log out
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </button>
        
        <x-forms.form method="POST" action="{{route('logout')}}" id="logout">
            
        </x-forms.form>
    </div>
    @endif
    @if (auth()->user()->type == 'district')
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('district_nurse_dashboard')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">dashboard</span>
            Dashboard
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('school_list')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">domain</span>
            School
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('district_report')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">summarize</span>
            Report
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('district_profile')}}" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">face</span>
            Profile
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </a>
        <button type="submit" form="logout" class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">power_settings_new</span>
            Log out
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </button>
        
        <x-forms.form method="POST" action="{{route('logout')}}" id="logout">
            
        </x-forms.form>
    </div>
    @endif
    @if (auth()->user()->type == 'division')
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('division_nurse_dashboard')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">dashboard</span>
            Dashboard
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('division_school_list')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">domain</span>
            School
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('division_report')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">summarize</span>
            Report
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('division_profile')}}" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">face</span>
            Profile
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </a>
        <button type="submit" form="logout" class="inline-flex items-center text-gray-600 hover:bg-gray-200 hover:text-black my-4 w-full py-4 rounded-md transition ease-in-out duration-150">
            <span class="material-icons-outlined mr-2">power_settings_new</span>
            Log out
            <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
        </button>
        
        <x-forms.form method="POST" action="{{route('logout')}}" id="logout">
            
        </x-forms.form>
    </div>
    @endif
    

    
    
</div>