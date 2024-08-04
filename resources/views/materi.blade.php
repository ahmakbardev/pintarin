@extends('layouts.layout')

@section('content')
    <div class="materi-content flex flex-col w-full">

        <div class="text mt-12">
            <h1 class="text-2xl font-semibold">{{ $materi->title }}</h1>
            <p class="mt-5">{!! $materi->content !!}</p>
        </div>
        <div class="aspect-video rounded-xl overflow-hidden">
            <iframe class="w-full h-full" src="{{ $materi->url }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
@endsection
