@if (in_array(Route::currentRouteName(), ['materi']))
    <div id="sidebar" class="shadow-md sticky top-24 z-40 px-12 bg-blackMain materi-sidebar-expanded">
        <div class="sticky top-24">
            <div class="relative">
                <button id="btn-sidebar"
                    class="absolute top-20 -right-[4.2rem] bg-primary flex justify-center items-center w-10 aspect-square rounded-full text-white">
                    <svg id="btn-icon" class="transition-transform duration-300" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                            fill="white" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="sticky top-24 pt-10 h-[55.1rem] flex flex-col gap-32">
            <div class="grid grid-cols-2 gap-3"></div>
            <div class="flex flex-col gap-[2rem] relative">
                <div class="text-feature absolute left-1.5 top-10 bottom-10 w-0.5 bg-white"></div>

                @foreach ($materis as $index => $materi)
                    <div class="flex gap-3 items-center relative">
                        <div
                            class="{{ in_array($materi->id, $completedMateriIds) ? 'bg-primary' : 'bg-white' }} relative flex items-center justify-center rounded-full">
                            <div
                                class="{{ in_array($materi->id, $completedMateriIds) ? 'circle-trigger bg-primary' : 'circle-trigger bg-white' }} w-3 aspect-square rounded-full relative flex items-center justify-center">
                            </div>
                        </div>
                        <div class="flex flex-col gap-5 items-center flex-1">
                            <a href="javascript:void(0);" class="block materi-link" data-id="{{ $materi->id }}">
                                <div
                                    class="{{ $materi->id == $currentMateri->id ? 'bg-primary text-white' : 'bg-white' }} py-4 px-4 rounded-xl flex flex-col max-w-80 gap-1 items-center">
                                    <p class="text-feature text-center">Materi {{ $loop->iteration }}:
                                        {{ $materi->title }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="flex gap-3 items-center relative">
                    <div class="bg-white relative flex items-center justify-center rounded-full">
                        <div
                            class="circle-trigger bg-white w-3 aspect-square rounded-full relative flex items-center justify-center">
                        </div>
                    </div>
                    <div class="flex flex-col gap-5 items-center flex-1">
                        @if ($allMateriCompleted)
                            <a href="{{ route('post-test', ['modulId' => $modul->id]) }}" class="block">
                                <div class="bg-white py-4 px-4 rounded-xl flex flex-col max-w-80 gap-1 items-center">
                                    <p class="text-feature text-center">Post Test</p>
                                </div>
                            </a>
                        @else
                            <div class="bg-white py-4 px-4 rounded-xl flex flex-col max-w-80 gap-1 items-center">
                                <p class="text-feature text-center">Post Test</p>
                                <p class="text-red-500 text-xs">Pelajari semua materi terlebih dahulu!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            sidebar.classList.toggle('materi-sidebar-expanded');
            sidebar.classList.toggle('materi-sidebar-collapsed');
            btnIcon.classList.toggle('own-rotate-180');

            if (window.innerWidth <= 1200) {
                document.body.classList.toggle('sidebar-visible');
            }
        });

        function checkWidth() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            if (window.innerWidth <= 1024) {
                sidebar.classList.add('sidebar-hidden');
                btnIcon.classList.add('own-rotate-180');
            } else {
                sidebar.classList.remove('sidebar-hidden');
                btnIcon.classList.remove('own-rotate-180');
            }

            if (window.innerWidth <= 1024) {
                var features = document.querySelectorAll('.feature, .text-feature');
                features.forEach(function(feature) {
                    feature.style.display = 'inline';
                });
            } else {
                var features = document.querySelectorAll('.feature, .text-feature');
                features.forEach(function(feature) {
                    feature.style.display = '';
                });
            }
        }

        checkWidth();
        window.addEventListener('resize', checkWidth);

        $('.materi-link').on('click', function() {
            var materiId = $(this).data('id');
            if (materiId) {
                window.location.href = `/materi/${materiId}`;
            }
        });
    </script>
@endif
