@extends('layouts.layout')

@section('content')
    <div class="materi-content flex flex-col w-full">
        <div class="relative flex items-center">
            <input type="text" class="outline-none ring-1 border-none py-3 px-7 rounded-full w-full" placeholder="Search">
            <button
                class="absolute right-2 bg-primary text-white rounded-full p-2 group hover:bg-white hover:ring-2 hover:ring-inset hover:ring-primary transition-all ease-in-out">
                <svg class="w-5 h-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.102 14.1189L10.4645 9.48138C11.1841 8.55103 11.5734 7.41353 11.5734 6.2171C11.5734 4.78496 11.0145 3.4421 10.0038 2.4296C8.99306 1.4171 7.64663 0.859955 6.21627 0.859955C4.78592 0.859955 3.43949 1.41888 2.42877 2.4296C1.41627 3.44031 0.859131 4.78496 0.859131 6.2171C0.859131 7.64746 1.41806 8.99388 2.42877 10.0046C3.43949 11.0171 4.78413 11.5742 6.21627 11.5742C7.4127 11.5742 8.54842 11.185 9.47877 10.4671L14.1163 15.1028C14.1299 15.1164 14.146 15.1272 14.1638 15.1346C14.1816 15.1419 14.2006 15.1457 14.2198 15.1457C14.2391 15.1457 14.2581 15.1419 14.2759 15.1346C14.2937 15.1272 14.3098 15.1164 14.3234 15.1028L15.102 14.326C15.1156 14.3124 15.1264 14.2963 15.1338 14.2785C15.1411 14.2607 15.1449 14.2417 15.1449 14.2225C15.1449 14.2032 15.1411 14.1842 15.1338 14.1664C15.1264 14.1486 15.1156 14.1325 15.102 14.1189ZM9.04485 9.04567C8.2877 9.80103 7.28413 10.2171 6.21627 10.2171C5.14842 10.2171 4.14485 9.80103 3.3877 9.04567C2.63235 8.28853 2.21627 7.28496 2.21627 6.2171C2.21627 5.14924 2.63235 4.14388 3.3877 3.38853C4.14485 2.63317 5.14842 2.2171 6.21627 2.2171C7.28413 2.2171 8.28949 2.63138 9.04485 3.38853C9.8002 4.14567 10.2163 5.14924 10.2163 6.2171C10.2163 7.28496 9.8002 8.29031 9.04485 9.04567Z"
                        class="fill-white group-hover:fill-primary transition-all ease-in-out" />
                </svg>
            </button>
        </div>
        <div class="flex flex-col gap-5 py-10">
            @foreach ($tugasProgress as $progress)
                <a href="{{ route('detail-review-option', ['progress_id' => $progress->id]) }}"
                    class="card bg-white shadow-md rounded-lg py-4 px-5 flex justify-between items-center transition-all ease-in-out hover:-translate-y-0.5 hover:ring-1 hover:ring-primary hover:ring-inset hover:shadow-lg">
                    <div class="flex gap-5 items-center">
                        <img src="{{ asset('assets/images/profile/default-profile.png') }}"
                            class="w-20 aspect-square object-cover rounded-full" alt="">
                        <div class="flex flex-col">
                            <p class="font-medium text-lg">{{ $selectedUser->name }}</p>
                            <p class="text-grayScale-500">{{ $selectedUser->nim }}</p>
                        </div>
                    </div>
                    <img src="{{ asset('assets/icons/stats.svg') }}" alt="">
                </a>
            @endforeach
        </div>

    </div>
@endsection
