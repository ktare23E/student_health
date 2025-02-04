
<div id="modal1" class="fixed bottom-0 right-0 w-96 bg-white p-4 border border-gray-300 rounded-lg shadow-lg hidden modal-enter">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Create School</h2>
        <button class="close text-gray-500 hover:text-gray-700">&times;</button>
    </div>
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School name</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="School Name" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ozamis City" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Principal</label>
                <input type="text" id="principal" name="principal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ms. Jane" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District</label>
                <select id="district_id" name="district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option selected>Select District</option>
                    @foreach ($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Type</label>
                <select id="school_type" name="school_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option>Select School Type</option>
                    <option value="Primary">Primary</option>
                    <option value="Secondary">Secondary</option>
                    <option value="Senior High">Senior High</option>
                </select>
            </div>
            {{-- <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option selected>Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                </select>
            </div> --}}
        </div>
        <button class="create_school bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</div>

<div id="edit_modal" class="fixed bottom-0 right-0 w-96 bg-white p-4 border border-gray-300 rounded-lg shadow-lg hidden modal-enter">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit School</h2>
        <button class="close text-gray-500 hover:text-gray-700">&times;</button>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School name</label>
            <input type="hidden" id="edit_school_id">
            <input type="text" id="edit_name" name="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" id="edit_address" name="edit_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ozamis City" required />
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Principal</label>
            <input type="text" id="edit_principal" name="edit_principal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ms. Jane" required />
        </div>
        
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District</label>
            <select id="edit_district_id" name="edit_district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option>Select District</option>
                @foreach ($districts as $district)
                    <option value="{{$district->id}}">{{$district->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Type</label>
            <select id="edit_school_type" name="edit_school_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option>Select School Type</option>
                <option value="Primary">Primary</option>
                <option value="Secondary">Secondary</option>
                <option value="Senior High">Senior High</option>
            </select>
        </div>
        
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select id="edit_status" name="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option>Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>
    <button class="update_school bg-blue-500 text-white px-4 py-2 rounded">update</button>
</div>