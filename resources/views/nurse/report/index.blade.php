<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">School Nurse Report</h1>
                    </div>


                    <div class="flex items-center justify-center p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-[50%] mx-auto">
                            <h1 class="font-bold mb-6">Filter Report</h1>
                            <div class="grid gap-6 mb-6 md:grid-cols-1">
                                <x-forms.form method="POST" action="{{ route('filter_report') }}">
                                    @csrf
                                    <div class="grid grid-cols-1 gap-2">
                                        @if (auth()->user()->type == 'district')
                                            <div>
                                                <label for="school_id"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                                                <select id="school_id" name="school_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
                                                    <option selected>Select School</option>
                                                    @foreach ($schools as $school)
                                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div>
                                            <label for="category"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                            <select id="category" name="category"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required>
                                                <option selected>Select Category</option>
                                                <option value="bmi_weight">BMI Weight</option>
                                                <option value="bmi_height">BMI Height</option>
                                                <option value="temperature">Temperature</option>
                                                <option value="heart_rate">Heart Rate</option>
                                                <option value="pulse_rate">Pulse Rate</option>
                                                <option value="respiratory_rate">Respiratory Rate</option>
                                                <option value="vision_screening">Vision Screening</option>
                                                <option value="auditory_screening">Auditory Screening</option>
                                                <option value="skin">Skin</option>
                                                <option value="scalp">Scalp</option>
                                                <option value="eyes">Eyes</option>
                                                <option value="nose">Nose</option>
                                                <option value="mouth">Mouth</option>
                                                <option value="lungs">Lungs</option>
                                                <option value="heart">Heart</option>
                                                <option value="abdomen">Abdomen</option>
                                                <option value="deformities">Deformities</option>
                                                <option value="iron_supplementation">Iron Supplementation</option>
                                                <option value="deworming">Deworming</option>
                                                <option value="immunization">Immunization</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="grade_level"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade
                                                Level</label>
                                            <select id="grade_level" name="grade_level"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required>
                                                <option selected>Select Grade Level</option>
                                                <option value="all">All</option>
                                                <option value="1">Grade 1</option>
                                                <option value="2">Grade 2</option>
                                                <option value="3">Grade 3</option>
                                                <option value="4">Grade 4</option>
                                                <option value="5">Grade 5</option>
                                                <option value="6">Grade 6</option>
                                                <option value="7">Grade 7</option>
                                                <option value="8">Grade 8</option>
                                                <option value="9">Grade 9</option>
                                                <option value="10">Grade 10</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="range"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                                Range</label>
                                            <select id="range" name="range"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required>
                                                <option selected>Select Range</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="annually">Annually</option>
                                                <option value="custom">Custom</option>
                                            </select>
                                        </div>
                                        <div id="custom-date-range" class="hidden">
                                            <label for="start_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                                Date</label>
                                            <input type="date" id="start_date" name="start_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <label for="end_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                                Date</label>
                                            <input type="date" id="end_date" name="end_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="w-full flex justify-center mt-4 items-center">
                                            <button class="py-1 px-2 bg-blue-500 text-white rounded-sm">Submit</button>
                                        </div>
                                    </div>
                                </x-forms.form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.getElementById('range').addEventListener('change', function () {
            const customDateRange = document.getElementById('custom-date-range');
            if (this.value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
