@extends('layouts.layout')

@section('content')
    <div class="materi-content relative grid grid-cols-3 w-full gap-5 py-5">
        <div class="h-fit sticky top-28 flex flex-col gap-5">
            <div class="bg-white py-6 px-6 rounded-lg shadow-md ">
                <div class="flex flex-col items-center w-full gap-5">
                    <img src="{{ asset('assets/images/profile/default-profile.png') }}"
                        class="w-20 aspect-square rounded-full" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-medium text-center">Itamara Shofinia Weladis Aini</h1>
                        <div class="flex flex-col gap-2">
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>NIM</p>
                                </div>
                                <p>: 200535626862</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>Dosen PA</p>
                                </div>
                                <p>: Dyah Lestari, S.T., M.Eng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white py-6 px-6 rounded-lg shadow-lg flex flex-col gap-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl">Post Test 1</h1>
                        <h4 class="text-base">Modul Pemimpin yang Memberdayakan</h4>
                    </div>
                    <div class="grid grid-cols-3 gap-5">
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info">
                            <img src="{{ asset('assets/icons/PDF.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/DOC.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/PPT.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl">Post Test 1</h1>
                        <h4 class="text-base">Modul Pemimpin yang Memberdayakan</h4>
                    </div>
                    <div class="grid grid-cols-3 gap-5">
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info">
                            <img src="{{ asset('assets/icons/PDF.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/DOC.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div
                            class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/PPT.png') }}" class="w-10 aspect-square object-cover"
                                alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2 flex flex-col gap-5 relative">
            <div class="bg-white flex flex-col gap-4 py-6 px-6 rounded-lg shadow-lg">
                <div class="w-full h-full rounded-lg">
                    <embed src="{{ asset('assets/pdf/default-pdf.pdf') }}" type="application/pdf" width="100%"
                        class="rounded-lg h-screen max-h-screen" />
                </div>
            </div>
            <div id="review-container"
                class="fixed bottom-2 right-2 bg-white flex flex-col gap-4 py-6 px-6 rounded-lg shadow-lg w-full max-w-2xl transform transition-transform duration-300 ease-in-out translate-y-full">
                <button id="close-review"
                    class="hidden absolute top-3 right-3 bg-primary text-white p-2 rounded-lg z-10"><i
                        data-feather="x"></i></button>
                <div id="chat-review" class="hidden bg-white flex flex-col gap-4 py-6 px-6 rounded-lg ring-1 ring-info-100"
                    data-simplebar style="max-height: 400px;">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="bg-white flex flex-col gap-2 px-4 py-2 rounded-lg shadow-md w-fit">
                            <h4 class="text-base font-medium">Akbar <span class="text-xs text-grayScale-300 ml-3">20 menit
                                    yang lalu</span></h4>
                            <p class="text-sm">Pesan akan muncul disini {{ $i + 1 }}</p>
                        </div>
                    @endfor
                    <div class="bg-info-50 flex ml-auto flex-col gap-2 px-4 py-2 rounded-lg shadow-md w-fit">
                        <h4 class="text-base font-medium">Akbar <span class="text-xs text-grayScale-300 ml-3">20 menit yang
                                lalu</span></h4>
                        <p class="text-sm">Pesan terakhir akan muncul disini</p>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var targetNode = document.querySelector('[data-simplebar]');

                        var observer = new MutationObserver(function(mutationsList, observer) {
                            for (var mutation of mutationsList) {
                                if (mutation.type === 'childList') {
                                    var simplebarContent = document.querySelector('.simplebar-content');
                                    if (simplebarContent) {
                                        simplebarContent.id = 'review'; // Menambahkan ID pada elemen
                                        observer.disconnect(); // Menghentikan pengamatan setelah ID ditambahkan
                                        break;
                                    }
                                }
                            }
                        });

                        observer.observe(targetNode, {
                            childList: true,
                            subtree: true
                        });
                    });
                </script>

                <div id="review-section" class="hidden flex flex-col">
                    <h1 class="text-xl font-medium mb-3">Review</h1>
                    <textarea name="" id="" rows="2"
                        class="py-3 px-4 border border-slate-300 mb-2 rounded-xl outline-none focus:ring-1 focus:ring-inset focus:ring-primary transition-all ease-in-out hover:ring-1 hover:ring-blue-300 hover:ring-inset"
                        placeholder="Tulis Review kamu disini" style="resize: none"></textarea>
                    <button class="bg-primary text-white py-4 px-10 rounded-xl font-medium">Kirim</button>
                </div>
            </div>

            <button id="toggle-review"
                class="fixed bottom-5 right-5 bg-primary text-white py-4 px-14 rounded-xl font-medium">Lihat Review</button>

            <script>
                document.getElementById('toggle-review').addEventListener('click', function() {
                    var reviewContainer = document.getElementById('review-container');
                    var reviewSection = document.getElementById('review-section');
                    var chatReview = document.getElementById('chat-review');
                    var toggleButton = document.getElementById('toggle-review');
                    var closeButton = document.getElementById('close-review');

                    reviewContainer.classList.remove('translate-y-full');
                    reviewContainer.classList.add('translate-y-0');
                    toggleButton.classList.add('hidden');
                    closeButton.classList.remove('hidden');

                    reviewSection.classList.remove('hidden');
                    reviewSection.classList.add('block');
                    chatReview.classList.remove('hidden');
                    chatReview.classList.add('block');
                });

                document.getElementById('close-review').addEventListener('click', function() {
                    var reviewContainer = document.getElementById('review-container');
                    var reviewSection = document.getElementById('review-section');
                    var chatReview = document.getElementById('chat-review');
                    var toggleButton = document.getElementById('toggle-review');
                    var closeButton = document.getElementById('close-review');

                    reviewContainer.classList.add('translate-y-full');
                    reviewContainer.classList.remove('translate-y-0');
                    toggleButton.classList.remove('hidden');
                    closeButton.classList.add('hidden');

                    reviewSection.classList.add('hidden');
                    reviewSection.classList.remove('block');
                    chatReview.classList.add('hidden');
                    chatReview.classList.remove('block');
                });
            </script>
        </div>


    </div>
@endsection
