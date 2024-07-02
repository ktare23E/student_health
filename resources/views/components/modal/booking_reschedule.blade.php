<div id="booking_reschedule" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-full">
        <div class="content_container relative bg-[#fff] p-[1.8rem] rounded-md max-w-[90%] max-h-[90vh] w-[20%] h-[300px] mx-auto my-auto">
            <div class="top flex align-center justify-between border-b border-black">
                <h3 class="requirement_name font-bold font text-xl">Booking Reschedule</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="booking_reschedule">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="student_information w-full h-full flex justify-center items-center">
                <div class="img_container w-full h-full flex flex-col justify-center items-center my-auto">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <label for="datetime" class="block text-gray-700 text-sm font-bold mb-2">Select Date
                            and Time:</label>
                        <input id="date" type="date" name="date"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded" min="{{ now()->toDateString() }}"  required>
                        <input id="time" type="time" name="time"
                            class="block w-full mt-1 p-2 border border-gray-300 rounded" required>
                        <div id="error" class="text-red-500 text-sm mt-2 hidden">Please select a future
                            date and time.</div>
                    </div>
                    <div>
                        <button id="reschedule" class="bg-black text-sm text-white font-bold py-2 px-4 rounded mt-4">Reschedule</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
