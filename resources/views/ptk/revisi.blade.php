@extends('layouts.layout')

@section('content')
    <div class="p-10 w-full">

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-lg sm:text-2xl font-semibold mb-5">Ajukan Revisi</h1>

            <!-- Form untuk mengajukan revisi proposal -->
            <form action="{{ route('PTK-revisi-proposal-submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="judul_id" value="{{ $proposal->judul_id }}">

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Judul Proposal -->
                    <div class="mb-4 col-span-2">
                        <label class="block text-grayScale-700 text-sm font-bold mb-2">
                            Judul
                        </label>
                        <p class="block w-full text-grayScale-700 focus:outline-none">
                            {{ $proposal->judul_proposal }}
                        </p>
                    </div>
                </div>
                <!-- Status dan Catatan -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-grayScale-700 text-sm font-bold mb-2">
                            Status Proposal
                        </label>
                        <div class="flex items-center gap-2">
                            <span
                                class="bg-{{ $proposal->status == 'diterima' ? 'green-500' : ($proposal->status == 'ditolak' ? 'red-500' : 'black') }} text-{{ $proposal->status == 'pending' ? 'yellow-500' : ($proposal->status == 'ditolak' ? 'white' : 'white') }} font-bold capitalize py-2 px-4 rounded-md">
                                {{ $proposal->status }}
                            </span>
                            <span class="text-{{ $proposal->status == 'DITOLAK' ? 'red' : 'green' }}-400">
                                {{ \Carbon\Carbon::parse($proposal->updated_at)->format('d M Y \\P\\u\\k\\u\\l H:i') }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-grayScale-700 text-sm font-bold mb-2">
                            Catatan
                        </label>
                        @if ($proposal->catatan)
                            <button onclick="showModal()" class="bg-red-50 text-red-400 py-2 px-4 rounded-md">Lihat
                                Catatan</button>
                        @else
                            <div class="bg-red-50 text-red-400 w-fit py-2 px-4 rounded-md">Belum Ada Catatan</div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Dosen Pembimbing -->
                    <div>
                        <label class="block text-grayScale-700 text-sm font-bold mb-2" for="dosen">
                            Dosen Pembimbing
                        </label>
                        <input type="text" id="dosen" value="{{ $dosen->dosen_nama ?? 'Belum ditentukan' }}" readonly
                            class="block w-full text-grayScale-300 px-3 py-2 border border-grayScale-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Unggah Berkas -->
                    <div>
                        <label class="block text-grayScale-700 text-sm font-bold mb-2" for="unggahBerkas">
                            Unggah Berkas
                        </label>
                        <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                            <label class="bg-blue-500 text-white px-4 py-2 cursor-pointer hover:bg-blue-700"
                                for="unggahBerkas">Pilih</label>
                            <input type="file" id="unggahBerkas" name="file" class="hidden"
                                onchange="updateFileName(this)">
                            <span id="fileName" class="pl-3 text-grayScale-500">Berkas kosong</span>
                        </div>
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

    <!-- Modal -->
    <div id="modalCatatan" class="fixed inset-0 bg-black bg-opacity-50 z-[12] hidden flex justify-center items-center">
        <div
            class="bg-white p-6 rounded-lg transform scale-75 w-full max-w-lg opacity-0 blur-sm transition-transform duration-500">
            <h2 class="text-lg font-bold mb-4">Catatan</h2>
            <p class="mb-4">{{ $proposal->catatan ?? 'Belum ada catatan' }}</p>
            <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                Tutup
            </button>
        </div>
    </div>

    <script>
        // Fungsi untuk memperbarui nama file yang ditampilkan setelah file diunggah
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = input.files[0].name;
            } else {
                fileNameDisplay.textContent = 'Berkas kosong';
            }
        }

        // Fungsi untuk menampilkan modal
        function showModal() {
            const modal = document.getElementById('modalCatatan');
            modal.classList.remove('hidden');
            setTimeout(() => {
                const modalContent = modal.querySelector('.transform');
                modalContent.classList.remove('scale-75', 'opacity-0', 'blur-sm');
                modalContent.classList.add('scale-100', 'opacity-100', 'blur-none');
            }, 100);
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('modalCatatan');
            const modalContent = modal.querySelector('.transform');
            modalContent.classList.remove('scale-100', 'opacity-100', 'blur-none');
            modalContent.classList.add('scale-75', 'opacity-0', 'blur-sm');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 500);
        }
    </script>
@endsection
