<div id="package_inclusion" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full bg-black bg-opacity-30 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-full">
        <div class="content_container relative bg-[#fff] p-[1.8rem] rounded-md max-w-[90%] max-h-[90vh] w-[40%] h-fit mx-auto my-auto">
            <div class="top flex align-center justify-between border-b border-black">
                <div class="flex justify-between items-center gap-12">
                    <h3 class="package_name font-bold font text-xl"></h3>
                    <h3 class="package_price"></h3>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="package_inclusion">
                    <svg class="w-3 h-3" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="student_information w-full h-full">
                <h1 class="mt-8">Packge Inclusions:</h1>
                {{-- list of service_variants --}}
                <div class="border rounded-md p-4 w-full mx-auto max-w-2xl ">
                    <div class="block w-full overflow-x-auto max-w-xl border">
                        <table class="service_variants_table  items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">
                                        Service Variants</th>
                                    <th
                                        class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">
                                        Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                         
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
