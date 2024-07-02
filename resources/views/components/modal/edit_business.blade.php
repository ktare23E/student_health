<div id="edit_business" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-full">
        <div class="content_container relative bg-gray-50 p-[1.8rem] rounded-md max-w-[90%] max-h-[90vh] md:w-[20%] lg:w-[30%] h-[400px] mx-auto my-auto">
            <div class="top flex align-center justify-between border-b border-black">
                <h3 class="requirement_name font-bold font text-xl">Edit Business</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit_business">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="student_information w-full h-full flex justify-center items-center overflow-y-hidden">
                <div class="img_container w-full h-fit flex flex-col justify-center items-center my-auto bg-gray-50 ">
                    <div class="bg-white p-6 rounded shadow-lg w-full">
                        <div>
                            <label for="datetime" class="block text-gray-700 text-sm font-bold mb-2">Business Name</label>
                            <input id="business_name" type="text" name="business_name"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded" placeholder="" required>
                        </div>
                        <div>
                            <label for="datetime" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <input id="address" type="text" name="address"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded" placeholder="" required>
                        </div>
                        <div>
                            <label for="datetime" class="block text-gray-700 text-sm font-bold mb-2">Contact Number</label>
                            <input id="contact_info" type="text" name="contact_info"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded" placeholder="" required>
                        </div>
                    </div>
                    <div>
                        <button id="update_business" class="bg-blue-500 text-sm text-white  py-2 px-4 rounded mt-4">update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
