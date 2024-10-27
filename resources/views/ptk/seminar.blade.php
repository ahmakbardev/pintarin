@extends('layouts.layout')

@section('content')
    <div class="p-10 w-full">
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Judul Lama -->
            <div class="mb-6">
                <h2 class="text-lg sm:text-2xl font-semibold mb-3">Judul Lama</h2>
                <p class="text-grayScale-700">Pengembangan Desain UI/UX FunLearning Terintegrasi dengan Layanan E-Store
                    Menggunakan Metode User-Centered Design</p>
                <div class="flex gap-2 text-grayScale-500 text-sm items-center mt-2">
                    <span>21 Juli 2024 Pukul 13:00</span>
                    <img src="{{ asset('assets/icons/ellipse.png') }}" class="h-fit" alt="">
                    <span class="text-grayScale-500">DITOLAK</span>
                    <img src="{{ asset('assets/icons/ellipse.png') }}" class="h-fit" alt="">
                    <span>Karena tidak menggambarkan isi abstrak</span>
                </div>
            </div>

            <!-- Judul Baru -->
            <div class="mb-6">
                <h2 class="text-lg sm:text-2xl font-semibold mb-3">Judul Baru</h2>
                <p class="text-blue-500 font-semibold">Analisis Dan Perancangan UI/UX Pada Perpustakaan Berjalan</p>
                <div class="flex justify-between text-grayScale-500 text-sm mt-2">
                    <span>21 Juli 2024 Pukul 23:59</span>
                </div>
            </div>

            <!-- Status dan Catatan -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Status Judul</label>
                    <div class="flex items-center gap-2">
                        <span class="bg-lime-500 text-white font-bold py-2 px-4 rounded-md">DITERIMA</span>
                        <span class="text-lime-500">22 Juli 2024 Pukul 07:15</span>
                    </div>
                </div>

                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Catatan</label>
                    <div class="bg-lime-50 text-lime-500 py-2 px-4 rounded-md">
                        Masih banyak typo, tolong diperbaiki.
                    </div>
                </div>
            </div>

            <!-- Form Revisi dan Seminar -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Berkas PTIK -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Berkas PTIK</label>
                    <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                        <label class="bg-blue-500 text-white px-4 py-2 cursor-pointer hover:bg-blue-700"
                            for="berkasPTIK">Pilih</label>
                        <input type="file" id="berkasPTIK" class="hidden"
                            onchange="updateFileName(this, 'fileNamePTIK')">
                        <span id="fileNamePTIK" class="pl-3 text-grayScale-500">Berkas kosong</span>
                    </div>
                </div>

                <!-- PPT Seminar Proposal -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">PPT Seminar Proposal</label>
                    <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                        <label class="bg-blue-500 text-white px-4 py-2 cursor-pointer hover:bg-blue-700"
                            for="pptSeminar">Pilih</label>
                        <input type="file" id="pptSeminar" class="hidden" onchange="updateFileName(this, 'fileNamePPT')">
                        <span id="fileNamePPT" class="pl-3 text-grayScale-500">Berkas kosong</span>
                    </div>
                </div>
            </div>

            <!-- Tanggal Pelaksanaan dan Jam Pelaksanaan -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Tanggal Pelaksanaan -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Tanggal Pelaksanaan</label>
                    <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                        <input type="date" class="w-full px-4 py-2 focus:outline-none" value="2024-07-29">
                        <span class="pr-4 text-grayScale-500">
                            <i data-feather="calendar"></i>
                        </span>
                    </div>
                </div>

                <!-- Jam Pelaksanaan -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Jam Pelaksanaan</label>
                    <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                        <input type="time" class="w-full px-4 py-2 focus:outline-none" value="09:00">
                        <span class="pr-4 text-grayScale-500">
                            <i data-feather="clock"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Aplikasi yang Digunakan dan Link Meeting -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <!-- Aplikasi yang Digunakan -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Aplikasi yang Digunakan</label>
                    <select class="w-full px-4 py-2 border border-grayScale-300 rounded-md focus:outline-none">
                        <option>Zoom/Google Meet</option>
                        <option>Microsoft Teams</option>
                        <option>Skype</option>
                    </select>
                </div>

                <!-- Link Meeting -->
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">Link Meeting</label>
                    <input type="text" class="w-full px-4 py-2 border border-grayScale-300 rounded-md focus:outline-none"
                        value="https://meet.google.com/dbq-yxgu-top">
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-center w-full">
                <button class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">
                    Submit
                </button>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input, elementId) {
            const fileName = input.files.length > 0 ? input.files[0].name : 'Berkas kosong';
            document.getElementById(elementId).textContent = fileName;
        }

        // Initialize Feather icons
        feather.replace();
    </script>
@endsection
