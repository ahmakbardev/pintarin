@extends('layouts.layout')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 w-full min-h-screen">
        <div class="bg-white flex justify-center items-center px-4 py-8 relative">
            <!-- Tombol Beranda -->
            <a href="/" class="absolute top-4 left-4 text-primary hover:text-primary flex items-center gap-2 m-5">
                <i data-feather="arrow-left" class="w-6 h-6"></i> Kembali ke Beranda
            </a>

            <div class="w-full max-w-xl p-8 rounded-2xl">
                <div class="flex flex-col gap-2 mb-6">
                    <h2 class="text-2xl font-bold text-start">Halo, Selamat Datang! 👋</h2>
                    <p>Masuk ke Pintarin.Edu untuk mengakses berbagai
                        materi ekslusif Pendidikan Profesi Guru.</p>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" id="nim" name="nim" required
                            placeholder="Masukkan Nomor Induk Mahasiswa"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                            placeholder="Masukkan kata sandi Anda"
                            class="mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox"
                                class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Ingat Saya
                            </label>
                        </div>
                        <p class="text-sm">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-sm text-primary hover:text-primary">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600 transition-all ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Masuk Akun
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
