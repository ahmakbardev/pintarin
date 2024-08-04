@extends('layouts.layout')

@section('content')
    <div class="materi-content flex flex-col w-full relative">
        <div class="text">
            <h1 class="text-3xl font-semibold">Hasil Post-Test</h1>
            @foreach ($questions as $index => $question)
                <div class="flex flex-col gap-4 items-center my-8">
                    @foreach (json_decode($question->answers) as $i => $answer)
                        <div
                            class="flex w-full lg:w-2/3 items-center gap-5 ring-1 p-3 rounded-lg
                            {{ $answer == $question->correct_answer ? 'ring-lime-500' : 'ring-slate-400' }}
                            {{ isset($answers[$index]) && $answers[$index] == $answer && $answer != $question->correct_answer ? 'ring-red-500' : '' }}">
                            <div
                                class="text-2xl font-semibold ring-1 duration-300 w-14 grid place-content-center p-3 rounded-lg aspect-square
                                {{ $answer == $question->correct_answer ? 'ring-lime-500' : 'ring-slate-400' }}
                                {{ isset($answers[$index]) && $answers[$index] == $answer && $answer != $question->correct_answer ? 'ring-red-500' : '' }}">
                                {{ chr(65 + $i) }}
                            </div>
                            <p>{{ $answer }}</p>
                            @if ($answer == $question->correct_answer)
                                <svg width="30" height="31" class="block" viewBox="0 0 30 31" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_132_1057" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0"
                                        y="1" width="30" height="29">
                                        <path
                                            d="M15 28C16.6418 28.0021 18.2679 27.6798 19.7848 27.0514C21.3016 26.4231 22.6793 25.5012 23.8388 24.3387C25.0012 23.1793 25.9231 21.8016 26.5515 20.2847C27.1798 18.7679 27.5021 17.1418 27.5 15.5C27.5021 13.8582 27.1797 12.2321 26.5514 10.7153C25.9231 9.19842 25.0012 7.82069 23.8388 6.66124C22.6793 5.49876 21.3016 4.57687 19.7848 3.94855C18.2679 3.32023 16.6418 2.99787 15 3C13.3582 2.9979 11.7321 3.32028 10.2153 3.9486C8.69843 4.57691 7.3207 5.49879 6.16126 6.66124C4.9988 7.82069 4.07693 9.19842 3.44861 10.7153C2.82029 12.2321 2.49792 13.8582 2.50001 15.5C2.49788 17.1418 2.82024 18.7679 3.44856 20.2847C4.07688 21.8016 4.99878 23.1793 6.16126 24.3387C7.3207 25.5012 8.69843 26.4231 10.2153 27.0514C11.7321 27.6797 13.3582 28.0021 15 28Z"
                                            fill="white" stroke="white" stroke-width="4" stroke-linejoin="round" />
                                        <path d="M10 15.5L13.75 19.25L21.25 11.75" stroke="black" stroke-width="4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </mask>
                                    <g mask="url(#mask0_132_1057)">
                                        <path d="M0 0.5H30V30.5H0V0.5Z" fill="#70E000" />
                                    </g>
                                </svg>
                                <div class="w-full block">
                                    <div
                                        class="flex flex-col justify-center gap-1 p-3 w-full ring-2 ring-lime-500 rounded-md">
                                        <h3 class="text-lg font-semibold">Penjelasan</h3>
                                        <p>{{ $question->description }}</p>
                                    </div>
                                </div>
                            @elseif (isset($answers[$index]) && $answers[$index] == $answer)
                                <svg width="33" height="33" viewBox="0 0 33 33" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.5002 1.83334C13.5994 1.83334 10.7637 2.69352 8.35181 4.30511C5.93988 5.91671 4.06002 8.20733 2.94994 10.8873C1.83985 13.5673 1.5494 16.5163 2.11532 19.3613C2.68124 22.2064 4.0781 24.8197 6.12927 26.8709C8.18044 28.9221 10.7938 30.3189 13.6388 30.8849C16.4839 31.4508 19.4329 31.1603 22.1129 30.0502C24.7928 28.9402 27.0835 27.0603 28.6951 24.6484C30.3067 22.2364 31.1668 19.4008 31.1668 16.5C31.1668 12.6102 29.6216 8.87964 26.8711 6.1291C24.1205 3.37857 20.39 1.83334 16.5002 1.83334ZM23.8335 22.0917C24.0766 22.3348 24.2132 22.6645 24.2132 23.0083C24.2132 23.3522 24.0766 23.6819 23.8335 23.925C23.5904 24.1681 23.2607 24.3047 22.9168 24.3047C22.573 24.3047 22.2433 24.1681 22.0002 23.925L16.5002 18.425L11.0002 23.9433C10.8798 24.0637 10.7369 24.1592 10.5796 24.2244C10.4223 24.2895 10.2537 24.323 10.0835 24.323C9.91326 24.323 9.74469 24.2895 9.58741 24.2244C9.43012 24.1592 9.28721 24.0637 9.16684 23.9433C9.04646 23.823 8.95097 23.68 8.88582 23.5228C8.82067 23.3655 8.78714 23.1969 8.78714 23.0267C8.78714 22.8564 8.82067 22.6879 8.88582 22.5306C8.95097 22.3733 9.04646 22.2304 9.16684 22.11L14.6668 16.5733L9.011 10.8717C8.76789 10.6286 8.63131 10.2988 8.63131 9.955C8.63131 9.61119 8.76789 9.28145 9.011 9.03834C9.25412 8.79522 9.58385 8.65864 9.92767 8.65864C10.2715 8.65864 10.6012 8.79522 10.8443 9.03834L16.5002 14.7583L22.156 9.1025C22.2764 8.98212 22.4193 8.88663 22.5766 8.82149C22.7339 8.75634 22.9024 8.72281 23.0727 8.72281C23.2429 8.72281 23.4115 8.75634 23.5688 8.82149C23.726 8.88663 23.869 8.98212 23.9893 9.1025C24.1097 9.22288 24.2052 9.36579 24.2704 9.52307C24.3355 9.68035 24.369 9.84893 24.369 10.0192C24.369 10.1894 24.3355 10.358 24.2704 10.5153C24.2052 10.6725 24.1097 10.8155 23.9893 10.9358L18.3335 16.5733L23.8335 22.0917Z"
                                        fill="#FF5449" />
                                </svg>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="flex justify-between items-center my-5">
                <a href="{{ route('post-test', ['modulId' => $questions[0]->modul_id]) }}"
                    class="flex gap-3 items-center hover:ring-2 hover:ring-primary transition-all ease-in-out py-3 px-6 rounded-full group">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                            class="group-hover:fill-primary transition-all ease-in-out" fill="black" />
                    </svg>
                    <p class="group-hover:text-primary transition-all ease-in-out">Ulangi</p>
                </a>
                <a href="{{ route('home') }}"
                    class="flex gap-3 items-center hover:ring-2 hover:ring-primary transition-all ease-in-out py-3 px-6 rounded-full group">
                    <p class="group-hover:text-primary transition-all ease-in-out">Selesai</p>
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="rotate-180">
                        <path
                            d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                            class="group-hover:fill-primary transition-all ease-in-out" fill="black" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection
