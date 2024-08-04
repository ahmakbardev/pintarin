@extends('layouts.layout')

@section('content')
    <div class="materi-content relative grid grid-cols-3 w-full gap-5 py-5">
        <div class="h-fit sticky top-28">
            <div class="bg-white py-6 px-6 rounded-lg shadow-md ">
                <div class="flex flex-col items-center w-full gap-5">
                    <img src="{{ asset('assets/images/profile/default-profile.png') }}"
                        class="w-20 aspect-square rounded-full" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-medium">Itamara Shofinia Weladis Aini</h1>
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
        </div>
        <div class="col-span-2 flex flex-col gap-5">
            <div class="bg-white py-6 px-6 rounded-lg shadow-lg flex flex-col gap-4">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl">Post Test 1</h1>
                        <h4 class="text-base">Modul Pemimpin yang Memberdayakan</h4>
                    </div>
                    <div class="grid grid-cols-3 gap-5">
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info">
                            <img src="{{ asset('assets/icons/PDF.png') }}" class="w-10 aspect-square object-cover" alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/DOC.png') }}" class="w-10 aspect-square object-cover" alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/PPT.png') }}" class="w-10 aspect-square object-cover" alt="">
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
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info">
                            <img src="{{ asset('assets/icons/PDF.png') }}" class="w-10 aspect-square object-cover" alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/DOC.png') }}" class="w-10 aspect-square object-cover" alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                        <div class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                            <img src="{{ asset('assets/icons/PPT.png') }}" class="w-10 aspect-square object-cover" alt="">
                            <h1 class="group-hover:font-medium">File 1</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white flex flex-col gap-4 py-6 px-6 rounded-lg shadow-lg">
                <h1 class="text-xl font-medium mb-3">Review</h1>
                <textarea name="" id="" rows="5" class="py-6 px-4 border border-slate-300 rounded-xl outline-none focus:ring-1 focus:ring-inset focus:ring-primary transition-all ease-in-out hover:ring-1 hover:ring-blue-300 hover:ring-inset" placeholder="Tulis Review kamu disini" style="resize: none"></textarea>
                <button class="bg-primary text-white py-4 rounded-xl font-medium">Kirim</button>
            </div>
        </div>
    </div>
@endsection
