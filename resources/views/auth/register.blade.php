@extends('layouts.layout')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 w-full min-h-screen">
        <div class="bg-white flex justify-center items-center px-4 py-8 relative">
            <a href="/" class="absolute top-4 left-4 text-primary hover:text-primary flex items-center gap-2 m-5">
                <i data-feather="arrow-left" class="w-6 h-6"></i> Kembali ke Beranda
            </a>

            <div class="w-full max-w-xl p-8 rounded-2xl">
                <div class="flex flex-col gap-2 mb-6">
                    <h2 class="text-2xl font-bold text-start">Registrasi Mahasiswa</h2>
                    <p>Silahkan buat akun terlebih dahulu untuk mengakses berbagai materi di Pintarin.Edu.</p>
                </div>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="dosen_id" class="block text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                        <div class="relative">
                            <button type="button" id="dosenSelectButton"
                                class="w-full px-3 py-4 border border-gray-300 text-start rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <span id="dosenSelectButtonText">Pilih Dosen Pembimbing</span>
                                <i data-feather="chevron-down"
                                    class="w-5 h-5 absolute right-4 top-1/2 transform -translate-y-1/2 transition-transform duration-200"></i>
                            </button>
                            <div id="dosenOptions"
                                class="absolute w-full bg-white border border-gray-300 rounded-md shadow-lg mt-2 hidden z-10 transition-all duration-300 transform scale-95 opacity-0">
                                @foreach ($dosens as $dosen)
                                    <div class="dosen-option px-3 py-4 cursor-pointer hover:bg-gray-100"
                                        data-value="{{ $dosen->id }}">
                                        {{ $dosen->name }}
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" id="dosen_id" name="dosen_id" value="">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" id="nim" name="nim" required
                            placeholder="Masukkan Nomor Induk Mahasiswa"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" required placeholder="Masukkan Nama Anda"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required placeholder="Masukkan Email Anda"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Sandi</label>
                        <input type="password" id="password" name="password" required
                            placeholder="Masukkan kata sandi Anda"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                            Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="Konfirmasi kata sandi Anda"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600 transition-all ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Buat Akun
                    </button>
                </form>
            </div>
        </div>
        <div class="hidden md:flex bg-[#2460C2] justify-center items-center relative px-4 py-8">
            <img src="{{ asset('assets/images/bg/bg.png') }}"
                class="absolute inset-0 w-full h-full z-0 opacity-60 object-cover pointer-events-none" alt="">
            <div
                class="bg-white/20 w-full max-w-lg flex flex-col items-center gap-5 p-6 backdrop-blur-[3px] border-2 border-slate-300 rounded-2xl">
                <h1 class="text-xl text-start sm:text-3xl pl-5 border-l-2 font-semibold text-white">Wujudkan Impianmu
                    menjadi Guru Profesional</h1>
                <img src="{{ asset('assets/images/auth/login.png') }}" class="w-full max-w-md object-fill" alt="">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dosenSelectButton = document.getElementById('dosenSelectButton');
            const dosenSelectButtonText = document.getElementById('dosenSelectButtonText');
            const dosenOptions = document.getElementById('dosenOptions');
            const dosenInput = document.getElementById('dosen_id');
            const dosenOptionElements = document.querySelectorAll('.dosen-option');

            dosenSelectButton.addEventListener('click', function() {
                dosenOptions.classList.toggle('hidden');
                dosenOptions.classList.toggle('block');
                setTimeout(() => {
                    if (dosenOptions.classList.contains('hidden')) {
                        dosenOptions.classList.remove('opacity-100');
                        dosenOptions.classList.remove('translate-y-0');
                        dosenOptions.classList.add('opacity-0');
                        dosenOptions.classList.add('translate-y-4');
                    } else {
                        dosenOptions.classList.remove('opacity-0');
                        dosenOptions.classList.remove('translate-y-4');
                        dosenOptions.classList.add('opacity-100');
                        dosenOptions.classList.add('translate-y-0');
                    }
                }, 0);

                const icon = dosenSelectButton.querySelector('i');
                icon.classList.toggle('rotate-180');
            });

            dosenOptionElements.forEach(option => {
                option.addEventListener('click', function() {
                    const value = option.getAttribute('data-value');
                    const text = option.innerText;
                    dosenSelectButtonText.innerText = text;
                    dosenInput.value = value;
                    dosenOptions.classList.add('hidden');
                    dosenOptions.classList.remove('block');
                    const icon = dosenSelectButton.querySelector('i');
                    icon.classList.remove('rotate-180');
                    dosenOptions.classList.remove('opacity-100');
                    dosenOptions.classList.remove('translate-y-0');
                    dosenOptions.classList.add('opacity-0');
                    dosenOptions.classList.add('translate-y-4');
                });
            });

            document.addEventListener('click', function(e) {
                if (!dosenSelectButton.contains(e.target) && !dosenOptions.contains(e.target)) {
                    dosenOptions.classList.add('hidden');
                    dosenOptions.classList.remove('block');
                    const icon = dosenSelectButton.querySelector('i');
                    icon.classList.remove('rotate-180');
                    dosenOptions.classList.remove('opacity-100');
                    dosenOptions.classList.remove('translate-y-0');
                    dosenOptions.classList.add('opacity-0');
                    dosenOptions.classList.add('translate-y-4');
                }
            });
        });

        feather.replace();
    </script>
@endsection
