<div id="user_booking" class="overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm hidden">
    <div class="flex items-center justify-center min-h-full">
        <div class="content_container relative rounded-md max-w-[90%] max-h-[90vh] w-[60%] h-[450px] mx-auto my-auto bg-gray-100 p-6 shadow-lg">
            <div class="top flex items-center justify-between border-b border-gray-300 mb-4 pb-2">
                <h3 class="requirement_name font-semibold text-lg">Client Booking</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="user_booking">
                    <svg class="w-4 h-4" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="w-full h-[93%] grid grid-cols-[1fr,2fr] gap-6 pb-4">
                <!-- Left side (Booking Details) -->
                <div class="h-full border-r-2 border-gray-300 pr-4">
                    <div class="booking_details border-b-2 border-gray-300 pb-4">
                        <h4 class="font-semibold mb-2">Booking Details</h4>
                        <p id="client-name" class="mb-1"></p>
                        <p id="booking-date" class="mb-1"></p>
                        <p id="total-price" class="mb-1"></p>
                        <p id="status" class="mb-1"></p>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-semibold mb-2">Payment Details</h4>
                        <div id="payment-details">
                            <!-- Payment details will be populated here -->
                        </div>
                    </div>
                </div>
                <!-- Right side (Booking Items Data) -->
                <div class="pl-4 h-full flex flex-col justify-between">
                    <div>
                        <h4 class="font-semibold mb-2">Booking Items</h4>
                        <div id="booking-items" class="space-y-5">
                            <!-- Booking items will be populated here -->
                        </div>
                    </div>
                    <div class="w-full flex justify-end">
                        <div class="booking_actions flex space-x-2">
                            <button type="button" class="approve px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-400 focus:outline-none">Approve</button>
                            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 focus:outline-none">Decline</button>
                            <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
