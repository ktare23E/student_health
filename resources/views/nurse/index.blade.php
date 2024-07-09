<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')


        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')

            @if (auth()->user()->type === 'division')
                <div class="w-10/12 pb-[100px]">
                    <div class="flex flex-row">
                        <div class="bg-no-repeat bg-red-200 border border-red-300 rounded-xl w-7/12 mr-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAvyFru8elv-S19NMGkQcztLLpDd6Y6VVVMqKhwISfNEpqV59iR5sJaPD4VTrz8ExV7WU9ryYPIUW8Gk2JmEm03OLBE2zAeQ3i7sjFx80O-7skVlsmlm0qRT0n7z9t07jU_E9KafA9l4rz68MsaZPazbDKBdcvEEEQPPc3TmZDsIhes1U-Z0YsH0uc2RSqEb0b83A1GNRo86e-8TbEoNqyX0gxBG-14Tawn0sZWLo5Iv96X-x10kVauME-Mc9HGS5G4h_26P2oHhiZ3SEgj6jW0KlEnsh2H_yTego0grbhdcN1Yjd_rLpyHUt5XhXHJwoqyJ_ylwvZD9-dRLgi_fM_7j/p.png?fv_content=true&size_mode=5); background-position: 90% center;">
                            <p class="text-2xl text-indigo-900">Welcome, <br><strong>{{$nurse->first_name.' '.$nurse->last_name}}</strong></p>
                            <p class="text-5xl text-indigo-900 mt-4">Student Health Information System</strong></p>
                        </div>

                        <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-5/12 ml-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hOObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
                            <p class="text-5xl text-indigo-900">Role: <br><strong>{{$nurse->type === 'division' ? 'Division Nurse': ($nurse->type === 'district' ? 'District Nurse' : 'School Nurse')}}</strong></p>
                        </div>
                    </div>
        
                    <div class="flex flex-row h-42 mt-6 gap-4">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3  max-h-24">
                                <h1 class="font-bold text-2xl">Division:</h1>
                                <div class="pl-4 w-full">
                                    @if ($division)
                                        <p class="text-center text-xl mt-4">{{$division[0]->name}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Division Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.division')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-2xl">District Under:</h1>
                                <div class="pl-4 w-full">
                                    @forelse ($division[0]->districts as $district)
                                        <p class=" text-center text-xl mt-4">{{$district->name}}</p>
                                    @empty
                                        <p class="text-center text-xl mt-4">No District Yet</p>
                                    @endforelse
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.district')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Active School:</h1>
                                <div class="pl-4 w-full">
                                    @forelse ($schools as $school)
                                        <p class="text-center text-sm">{{$school->name}}</p>
                                    @empty
                                        <p class="text-center text-xl mt-4">No School Yet</p>
                                    @endforelse
                                </div>
                            </div>
                            <a href="{{route('division_school_list')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a>
                        </div>
                    </div>
                    <div class="flex flex-row h-42 mt-6 gap-4 ">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Nurse Assigned:</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-xl mt-4">{{$nurse->first_name.' '.$nurse->last_name}}</p>

                                </div>
                            </div>
                            {{-- <a href="{{route('admin_nurse')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-2xl">Number of Active Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($activeStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$activeStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Number of Inactive Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($inactiveStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$inactiveStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                    </div>
                    
                </div>
            @elseif (auth()->user()->type === 'district')
                <div class="w-10/12 pb-[100px]">
                    <div class="flex flex-row">
                        <div class="bg-no-repeat bg-red-200 border border-red-300 rounded-xl w-7/12 mr-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAvyFru8elv-S19NMGkQcztLLpDd6Y6VVVMqKhwISfNEpqV59iR5sJaPD4VTrz8ExV7WU9ryYPIUW8Gk2JmEm03OLBE2zAeQ3i7sjFx80O-7skVlsmlm0qRT0n7z9t07jU_E9KafA9l4rz68MsaZPazbDKBdcvEEEQPPc3TmZDsIhes1U-Z0YsH0uc2RSqEb0b83A1GNRo86e-8TbEoNqyX0gxBG-14Tawn0sZWLo5Iv96X-x10kVauME-Mc9HGS5G4h_26P2oHhiZ3SEgj6jW0KlEnsh2H_yTego0grbhdcN1Yjd_rLpyHUt5XhXHJwoqyJ_ylwvZD9-dRLgi_fM_7j/p.png?fv_content=true&size_mode=5); background-position: 90% center;">
                            <p class="text-2xl text-indigo-900">Welcome, <br><strong>{{$nurse->first_name.' '.$nurse->last_name}}</strong></p>
                            <p class="text-5xl text-indigo-900 mt-4">Student Health Information System</strong></p>
                        </div>

                        <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-5/12 ml-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hOObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
                            <p class="text-5xl text-indigo-900">Role: <br><strong>{{$nurse->type === 'division' ? 'Division Nurse': ($nurse->type === 'district' ? 'District Nurse' : 'School Nurse')}}</strong></p>
                        </div>
                    </div>
        
                    <div class="flex flex-row h-42 mt-6 gap-4">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3  max-h-24">
                                <h1 class="font-bold text-2xl">Division Head:</h1>
                                <div class="pl-4 w-full">
                                    @if ($division)
                                        <p class="text-center text-xl mt-4">{{$division[0]->name}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Division Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.division')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-2xl">District:</h1>
                                <div class="pl-4 w-full">
                                    @forelse ($division[0]->districts as $district)
                                        <p class=" text-center text-xl mt-4">{{$district->name}}</p>
                                    @empty
                                        <p class="text-center text-xl mt-4">No District Yet</p>
                                    @endforelse
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.district')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Active School:</h1>
                                <div class="pl-4 w-full">
                                    @forelse ($schools as $school)
                                        <p class="text-center text-sm">{{$school->name}}</p>
                                    @empty
                                        <p class="text-center text-xl mt-4">No School Yet</p>
                                    @endforelse
                                </div>
                            </div>
                            <a href="{{route('division_school_list')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a>
                        </div>
                    </div>
                    <div class="flex flex-row h-42 mt-6 gap-4 ">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Nurse Assigned:</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-xl mt-4">{{$nurse->first_name.' '.$nurse->last_name}}</p>

                                </div>
                            </div>
                            {{-- <a href="{{route('admin_nurse')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-2xl">Number of Active Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($activeStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$activeStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Number of Inactive Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($inactiveStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$inactiveStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            {{-- <a href="" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                    </div>
                    
                </div>
            @else
                <div class="w-10/12 pb-[100px]">
                    <div class="flex flex-row">
                        <div class="bg-no-repeat bg-red-200 border border-red-300 rounded-xl w-7/12 mr-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAvyFru8elv-S19NMGkQcztLLpDd6Y6VVVMqKhwISfNEpqV59iR5sJaPD4VTrz8ExV7WU9ryYPIUW8Gk2JmEm03OLBE2zAeQ3i7sjFx80O-7skVlsmlm0qRT0n7z9t07jU_E9KafA9l4rz68MsaZPazbDKBdcvEEEQPPc3TmZDsIhes1U-Z0YsH0uc2RSqEb0b83A1GNRo86e-8TbEoNqyX0gxBG-14Tawn0sZWLo5Iv96X-x10kVauME-Mc9HGS5G4h_26P2oHhiZ3SEgj6jW0KlEnsh2H_yTego0grbhdcN1Yjd_rLpyHUt5XhXHJwoqyJ_ylwvZD9-dRLgi_fM_7j/p.png?fv_content=true&size_mode=5); background-position: 90% center;">
                            <p class="text-2xl text-indigo-900">Welcome, <br><strong>{{$nurse->first_name.' '.$nurse->last_name}}</strong></p>
                            <p class="text-5xl text-indigo-900 mt-4">Student Health Information System</strong></p>
                        </div>

                        <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-5/12 ml-2 p-6"
                            style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hOObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
                            <p class="text-5xl text-indigo-900">Role: <br><strong>{{$nurse->type === 'division' ? 'Division Nurse': ($nurse->type === 'district' ? 'District Nurse' : 'School Nurse')}}</strong></p>
                        </div>
                    </div>
        
                    <div class="flex flex-row h-42 mt-6 gap-4">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3  max-h-24">
                                <h1 class="font-bold text-2xl">Number of Checkup Made:</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-xl mt-4">{{$nurseCheckupCount}}</p>

                                </div>
                            </div>
                            {{-- <a href="{{route('admin.division')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Latest Checkup Made:</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-md">Student: {{$latestCheckup->student->first_name.' '.$latestCheckup->student->last_name}}</p>
                                    <p class="text-center text-md">Date of Checkup: {{ \Carbon\Carbon::parse($latestCheckup->date_of_checkup)->format('F j, Y, g:i A') }}
                                    </p>
                                </div>
                            </div>
                            {{-- <a href="{{route('admin.district')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">School Assigned :</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-xl mt-4">{{$school[0]->name}}</p>
                                </div>
                            </div>
                            {{-- <a href="{{route('division_school_list')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                    </div>
                    <div class="flex flex-row h-42 mt-6 gap-4 ">
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Nurse Assigned:</h1>
                                <div class="pl-4 w-full">
                                    <p class="text-center text-xl mt-4">{{$nurse->first_name.' '.$nurse->last_name}}</p>

                                </div>
                            </div>
                            {{-- <a href="{{route('admin_nurse')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a> --}}
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-2xl">Number of Active Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($activeStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$activeStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            <a href="{{route('student_list')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg w-4/12 flex flex-col justify-between">
                            <div class="px-4 py-3 max-h-24">
                                <h1 class="font-bold text-xl">Number of Inactive Student :</h1>
                                <div class="pl-4 w-full">
                                    @if ($inactiveStudentNumber)
                                        <p class=" text-center text-xl mt-4">{{$inactiveStudentNumber}}</p>
                                    @else
                                        <p class="text-center text-xl mt-4">No Inactive Student Yet</p>
                                    @endif
                                </div>
                            </div>
                            <a href="{{route('school.archive_student')}}" class="mt-2 bg-blue-950 text-white rounded-sm overflow-hidden py-2 px-3 block w-full text-center">View details</a>
                        </div>
                    </div>
                    
                </div>
            @endif
        </div>
    </div>
</x-layout>
