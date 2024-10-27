@extends('layouts.layout')

@section('content')
    <div class="p-10 w-full">

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-lg sm:text-2xl font-semibold mb-5">Ajukan Revisi Judul</h1>
            <form id="judulRevisiForm" action="{{ route('PTK-judul-revisi-submit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Dosen Pembimbing -->
                    <div class="mb-4">
                        <label class="block text-grayScale-700 text-sm font-bold mb-2">
                            Judul PTK Lama
                        </label>
                        <p class="block w-full text-grayScale-700 focus:outline-none">
                            {{ $judul->judul }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-grayScale-700 text-sm font-bold mb-2" for="dosen">
                            Dosen Pembimbing
                        </label>
                        <input type="text" id="dosen" value="Dyah Lestari, S.T., M.Eng." readonly
                            class="block w-full text-grayScale-300 px-3 py-2 border border-grayScale-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="mb-4 col-span-2">
                        <label class="block text-grayScale-700 text-sm font-bold mb-2">
                            Ajukan Judul Baru
                        </label>
                        <input type="text" name="judul" id="judulBaru" placeholder="Tulis Judul Baru disini"
                            class="block w-full px-3 py-2 border border-grayScale-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <span id="judulError" class="text-red-500 text-sm hidden mt-2"></span>
                    </div>
                </div>

                <!-- Tombol Kerjakan Revisi -->
                <div class="flex justify-center w-full">
                    <button type="submit"
                        class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">
                        Kerjakan Revisi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('judulRevisiForm').addEventListener('submit', function(event) {
            const judulInput = document.getElementById('judulBaru');
            const judulError = document.getElementById('judulError');
            const judulValue = judulInput.value.trim();

            // Regex to check for special characters
            const specialCharPattern = /[^a-zA-Z0-9\s]/;

            // Clear previous error message
            judulError.classList.add('hidden');
            judulError.textContent = '';

            // Validasi untuk input kosong
            if (judulValue === '') {
                judulError.textContent = 'Judul baru tidak boleh kosong.';
                judulError.classList.remove('hidden');
                showMessage('error', 'Judul baru tidak boleh kosong.');
                event.preventDefault();
                return;
            }

            // Validasi untuk karakter khusus
            if (specialCharPattern.test(judulValue)) {
                judulError.textContent = 'Judul tidak boleh mengandung karakter khusus.';
                judulError.classList.remove('hidden');
                showMessage('error', 'Judul tidak boleh mengandung karakter khusus.');
                event.preventDefault();
                return;
            }

            // Jika validasi berhasil, tampilkan pesan sukses
            showMessage('success', 'Judul berhasil diajukan!');
        });
    </script>
@endsection
