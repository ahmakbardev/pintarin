@extends('layouts.layout')

@section('content')
    <div class="p-10 w-full">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-lg sm:text-2xl font-semibold mb-5">Status Judul</h1>

            <!-- Dosen Pembimbing -->
            <div class="flex flex-col col-span-2">
                <label class="block text-grayScale-700 text-sm font-bold mb-2" for="dosen">
                    Dosen Pembimbing
                </label>
                <p class="block w-full text-grayScale-500 rounded-md focus:outline-none">
                    {{ $dosen->name ?? 'Dosen tidak ditemukan' }}
                </p>
            </div>

            <!-- Judul PTIK -->
            <div class="mb-4 mt-6 col-span-2">
                <label class="block text-grayScale-700 text-sm font-bold mb-2" for="judulPTIK">
                    Judul PTIK
                </label>
                <p class="block w-full text-grayScale-500 rounded-md focus:outline-none">
                    {{ $judul->judul }}
                </p>
            </div>

            <!-- Status dan Catatan -->
            <div class="grid grid-cols-2 gap-4 mb-4 col-span-2">
                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">
                        Status Judul
                    </label>
                    <div class="flex items-center gap-2">
                        <span
                            class="bg-{{ $judul->status == 'diterima' ? 'green-500' : ($judul->status == 'ditolak' ? 'red-500' : 'black') }} text-{{ $judul->status == 'pending' ? 'yellow-500' : ($judul->status == 'ditolak' ? 'white' : 'white') }} font-bold capitalize py-2 px-4 rounded-md">
                            {{ $judul->status }}
                        </span>
                        <span class="text-{{ $judul->status == 'ditolak' ? 'red' : 'green' }}-400">
                            {{ \Carbon\Carbon::parse($judul->updated_at)->format('d M Y \\P\\u\\k\\u\\l H:i') }}
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-grayScale-700 text-sm font-bold mb-2">
                        Catatan
                    </label>
                    @if ($judul->catatan)
                        <button onclick="showModal()" class="bg-red-50 text-red-400 py-2 px-4 rounded-md">Lihat
                            Catatan</button>
                    @else
                        <div class="bg-red-50 text-red-400 w-fit py-2 px-4 rounded-md">Belum Ada Catatan</div>
                    @endif
                </div>
            </div>

            <!-- Tombol Kerjakan Revisi -->
            <div class="flex justify-center w-full col-span-2">
                <a href="{{ route('PTK-judul-revisi') }}"
                    class="bg-blue-500 text-center w-full hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">
                    Kerjakan Revisi
                </a>
            </div>
        </div>

        <!-- Tabel Revisi -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-lg font-semibold mb-4">Riwayat Revisi</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border py-2 px-4">No.</th>
                        <th class="border py-2 px-4">Judul</th>
                        <th class="border py-2 px-4">Tanggal Revisi</th>
                        <th class="border py-2 px-4">Catatan</th>
                        <th class="border py-2 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($revisi as $index => $rev)
                        <tr>
                            <td class="border py-2 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="border py-2 px-4 text-center">{{ $rev->judul }}</td>
                            <td class="border py-2 px-4 text-center">
                                {{ \Carbon\Carbon::parse($rev->created_at)->format('d M Y') }}</td>
                            <td class="border py-2 px-4">{{ $rev->catatan ?? 'Belum ada catatan' }}</td>
                            <td class="border py-2 px-4 text-center">
                                <span
                                    class="bg-{{ $rev->status == 'Selesai' ? 'green' : ($rev->status == 'ditolak' ? 'red' : 'yellow') }}-500 text-white py-1 px-3 rounded-full">
                                    {{ $rev->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalCatatan" class="fixed inset-0 bg-black bg-opacity-50 z-[12] hidden flex justify-center items-center">
        <div
            class="bg-white p-6 rounded-lg transform scale-75 w-full max-w-lg opacity-0 blur-sm transition-transform duration-500">
            <h2 class="text-lg font-bold mb-4">Catatan</h2>
            <p class="mb-4">{{ $judul->catatan ?? 'Belum ada catatan' }}</p>
            <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function showModal() {
            const modal = document.getElementById('modalCatatan');
            modal.classList.remove('hidden');
            setTimeout(() => {
                const modalContent = modal.querySelector('.transform');
                modalContent.classList.remove('scale-75', 'opacity-0', 'blur-sm');
                modalContent.classList.add('scale-100', 'opacity-100', 'blur-none');
            }, 100);
        }

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
