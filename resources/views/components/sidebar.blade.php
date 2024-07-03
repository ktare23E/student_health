<div class="w-2/12 mr-6">
    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="{{route('admin.index')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">dashboard</span>
            Dashboard
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('admin.division')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">apartment</span>
            Division
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('admin.district')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">domain</span>
            District
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('admin.school')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">domain</span>
            School
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('admin_nurse')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">medication</span>
            Nurse
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="{{route('archive_nurse')}}" class="inline-block text-gray-600 hover:text-black my-4 w-full">
            <span class="material-icons-outlined float-left pr-2">medication</span>
            Archive Nurse
            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="" class="inline-flex items-center text-gray-600 hover:text-black my-4 w-full rounded-md transition ease-in-out duration-150">
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
    
</div>