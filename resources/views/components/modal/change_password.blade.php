<div id="modal1" class="fixed bottom-0 right-0 w-96 bg-white p-4 border border-gray-300 rounded-lg shadow-lg hidden modal-enter">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Change Password</h2>
        <button class="close text-gray-500 hover:text-gray-700">&times;</button>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
            <div class="relative">
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pr-10" placeholder="****" required />
                <span class="material-icons absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" id="toggle-password">visibility</span>
            </div>
        </div>
    </div>
    <button class="change_password bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</div>
