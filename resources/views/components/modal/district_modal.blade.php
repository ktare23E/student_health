
<div id="modal1" class="fixed bottom-0 right-0 w-96 bg-white p-4 border border-gray-300 rounded-lg shadow-lg hidden modal-enter">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Create District</h2>
        <button class="close text-gray-500 hover:text-gray-700">&times;</button>
    </div>
        <div class="grid gap-6 mb-6 md:grid-cols-1">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District name</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="District Name" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ozamis City" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District Head</label>
                <input type="text" id="district_head" name="district_head" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mr. John Doe" required />
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                <select id="division_id" name="division_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option selected>Select Division</option>
                    @foreach ($divisions as $division)
                        <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="create_district bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</div>

<div id="edit_modal" class="fixed bottom-0 right-0 w-96 bg-white p-4 border border-gray-300 rounded-lg shadow-lg hidden modal-enter">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit District</h2>
        <button class="close text-gray-500 hover:text-gray-700">&times;</button>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division name</label>
            <input type="hidden" id="edit_district_id">
            <input type="text" id="edit_name" name="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" id="edit_address" name="edit_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ozamis City" required />
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District Head</label>
            <input type="text" id="edit_district_head" name="edit_district_head" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mr. John Doe" required />
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
            <select id="edit_division_id" name="edit_division_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option>Select Division</option>
                @foreach ($divisions as $division)
                    <option value="{{$division->id}}">{{$division->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button class="update_district bg-blue-500 text-white px-4 py-2 rounded">update</button>
</div>