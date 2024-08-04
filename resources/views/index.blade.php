@extends('layouts.layout')

@section('content')
    <div class="container-index w-full">
        <div class="topik pb-28 pt-20 flex justify-between">
            <div
                class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 active">
                <img class="h-full object-fill" src="{{ asset('assets/icons/prinsip.png') }}" alt=""
                    data-category="prinsip">
                <p class="text-center transition-all font-semibold">Prinsip Pengajaran</p>
            </div>
            <div
                class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 opacity-50">
                <img class="h-full object-fill" src="{{ asset('assets/icons/asesmen.png') }}" alt=""
                    data-category="pengembangan">
                <p class="text-center transition-all group-hover:font-semibold">Pengembangan Asesmen</p>
            </div>
            <div
                class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 opacity-50">
                <img class="h-full object-fill" src="{{ asset('assets/icons/PTK.png') }}" alt=""
                    data-category="ptk">
                <p class="text-center transition-all group-hover:font-semibold">PTK</p>
            </div>
        </div>

        <div class="modul">
            <h1 class="text-xl">Daftar Modul Topik 1: Coaching untuk Pemimpin di Satuan Pendidikan</h1>
            <div class="grid grid-cols-2 gap-6 my-4" id="modulContainer">
                <!-- Modul akan dimuat di sini melalui jQuery -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load default category "prinsip" on page load
            fetchModuls('prinsip');
            setActiveCategory('prinsip');

            // Handle category clicks
            $('.group img').on('click', function() {
                const category = $(this).data('category');
                fetchModuls(category);
                setActiveCategory(category);
            });

            function fetchModuls(category) {
                $.ajax({
                    url: `/moduls/${category}`,
                    type: 'GET',
                    success: function(moduls) {
                        $('#modulContainer').empty();
                        if (moduls.length === 0) {
                            $('#modulContainer').append(
                                '<p class="col-span-2 text-center">No modules found.</p>');
                        } else {
                            moduls.forEach(modul => {
                                const progressPercentage = modul.total_materi > 0 ? (modul
                                    .completed_materi / modul.total_materi) * 100 : 0;
                                const modulHtml = `
                                    <a href="/modul/${modul.id}" class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                                        <img class="w-16" src="{{ asset('assets/icons/modul-1.png') }}" alt="">
                                        <div class="flex flex-col w-full">
                                            <p class="text-xs">Modul</p>
                                            <p class="text-lg">${modul.name}</p>
                                            <div class="flex items-center mt-2">
                                                <div class="w-2/3 bg-gray-200 rounded-full h-2.5 dark:bg-gray">
                                                    <div class="bg-primary h-2.5 rounded-full" style="width: ${progressPercentage}%"></div>
                                                </div>
                                                <p class="text-base ml-4">${modul.completed_materi}/${modul.total_materi} materi</p>
                                            </div>
                                        </div>
                                    </a>
                                `;
                                $('#modulContainer').append(modulHtml);
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            function setActiveCategory(category) {
                $('.group').removeClass('active opacity-100').addClass('opacity-50');
                $(`img[data-category="${category}"]`).closest('.group').removeClass('opacity-50').addClass(
                    'active opacity-100');
            }
        });
    </script>

    <style>
        .group.active {
            opacity: 1 !important;
            transform: scale(1.05);
        }
    </style>
@endsection
