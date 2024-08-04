@extends('layouts.layout')

@section('content')
    <div class="min-h-screen w-full bg-blue-600 flex flex-col items-center justify-center">
        <!-- Navbar -->
        <div class="flex justify-between items-center w-full px-10 py-5 fixed top-0">
            <div class="flex items-center">
                <img src="{{ asset('assets/logo/logo_fix.png') }}" class="w-10 h-10 object-contain" alt="Pintarin.edu">
                <h1 class="text-white text-lg font-bold ml-3">Pintarin.Edu</h1>
            </div>
            <a href="{{ route('login') }}"
                class="bg-white text-blue-600 font-semibold py-2 px-4 rounded-lg hover:bg-gray-100 transition">
                Masuk
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center mt-10">
            <h1 class="text-3xl font-bold text-white mb-6">Tutorial Menggunakan Pintarin.Edu</h1>
            <div class="w-full max-w-4xl">
                <iframe class="rounded-md w-full aspect-video"
                    src="https://www.youtube.com/embed/hM_8AlSqncI?si=auTVJnJzXbbhj35W" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
