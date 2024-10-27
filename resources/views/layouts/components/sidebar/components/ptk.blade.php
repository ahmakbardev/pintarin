@if (in_array(Route::currentRouteName(), ['PTK-proposal', 'PTK-revisi-proposal', 'PTK-seminar', 'PTK-judul', 'PTK-judul-revisi']))
    <div id="sidebar" class="shadow-md sticky top-24 z-40 px-6 bg-blackMain materi-sidebar-expanded">
        <div class="sticky top-24">
            <div class="relative">
                <button id="btn-sidebar"
                    class="absolute top-20 -right-[2.7rem] bg-primary flex justify-center items-center w-10 aspect-square rounded-full text-white">
                    <svg id="btn-icon" class="transition-transform duration-300" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                            fill="white" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="sticky top-24 pt-10 h-[55.1rem] flex flex-col gap-20">
            <div class="grid grid-cols-2 gap-3"></div>
            <div class="flex flex-col gap-[2rem] relative">
                <ul class="flex flex-col gap-0 flex-1">
                    <!-- Menu Judul -->
                    <li class="cursor-pointer">
                        <button
                            class="flex justify-between items-center w-full py-4 text-white font-medium px-3 rounded-md 
                            {{ in_array(Route::currentRouteName(), ['PTK-judul', 'PTK-judul-revisi']) ? 'bg-primary' : 'hover:bg-opacity-75 hover:bg-primary' }}"
                            onclick="toggleCollapse('judul-collapse', 'judul-icon')">
                            <span class="flex items-center gap-3">
                                @include('icons.ptk-school')
                                Judul
                            </span>
                            <svg id="judul-icon"
                                class="w-4 h-4 transition-transform duration-300 
                                {{ in_array(Route::currentRouteName(), ['PTK-judul', 'PTK-judul-revisi']) ? 'rotate-180' : 'rotate-0' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul id="judul-collapse"
                            class="pl-4 overflow-hidden max-h-0 transition-all duration-500 ease-in-out 
                            {{ in_array(Route::currentRouteName(), ['PTK-judul', 'PTK-judul-revisi']) ? 'max-h-full' : '' }}">
                            <li class="cursor-pointer py-2">
                                <a href="{{ route('PTK-judul') }}"
                                    class="block text-white 
                                    {{ Route::currentRouteName() == 'PTK-judul' ? 'font-bold' : '' }}">Status
                                    Judul</a>
                            </li>
                            <li class="cursor-pointer py-2">
                                <a href="{{ route('PTK-judul-revisi') }}"
                                    class="block text-white 
                                    {{ Route::currentRouteName() == 'PTK-judul-revisi' ? 'font-bold' : '' }}">Revisi
                                    Judul</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Menu Proposal -->
                    <li class="cursor-pointer">
                        <button
                            class="flex justify-between items-center w-full py-4 text-white font-medium px-3 rounded-md 
                            {{ in_array(Route::currentRouteName(), ['PTK-proposal', 'PTK-revisi-proposal', 'PTK-seminar']) ? 'bg-primary' : 'hover:bg-opacity-75 hover:bg-primary' }}"
                            onclick="toggleCollapse('proposal-collapse', 'proposal-icon')">
                            <span class="flex items-center gap-3">
                                @include('icons.ptk-school')
                                Proposal
                            </span>
                            <svg id="proposal-icon"
                                class="w-4 h-4 transition-transform duration-300 
                                {{ in_array(Route::currentRouteName(), ['PTK-proposal', 'PTK-revisi-proposal', 'PTK-seminar']) ? 'rotate-180' : 'rotate-0' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul id="proposal-collapse"
                            class="pl-4 overflow-hidden max-h-0 transition-all duration-500 ease-in-out 
                            {{ in_array(Route::currentRouteName(), ['PTK-proposal', 'PTK-revisi-proposal', 'PTK-seminar']) ? 'max-h-full' : '' }}">
                            <li class="cursor-pointer py-2">
                                <a href="{{ route('PTK-proposal') }}"
                                    class="block text-white 
                                    {{ Route::currentRouteName() == 'PTK-proposal' ? 'font-bold' : '' }}">Status
                                    Proposal</a>
                            </li>
                            <li class="cursor-pointer py-2">
                                <a href="{{ route('PTK-revisi-proposal') }}"
                                    class="block text-white 
                                    {{ Route::currentRouteName() == 'PTK-revisi-proposal' ? 'font-bold' : '' }}">Revisi
                                    Proposal</a>
                            </li>
                            <li class="cursor-pointer py-2">
                                <a href="{{ route('PTK-seminar') }}"
                                    class="block text-white 
                                    {{ Route::currentRouteName() == 'PTK-seminar' ? 'font-bold' : '' }}">Seminar
                                    Proposal</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function toggleCollapse(id) {
            const collapseElement = document.getElementById(id);
            const icon = document.getElementById(id.replace('collapse', 'icon'));

            if (collapseElement.style.maxHeight && collapseElement.style.maxHeight !== "0px") {
                // Collapse the content
                collapseElement.style.maxHeight = "0px";
                collapseElement.classList.add('opacity-0');
                icon.classList.remove('rotate-180');
                icon.classList.add('rotate-0');
            } else {
                // Expand the content
                collapseElement.style.maxHeight = collapseElement.scrollHeight + "px";
                collapseElement.classList.remove('opacity-0');
                icon.classList.remove('rotate-0');
                icon.classList.add('rotate-180');
            }
        }



        document.getElementById('btn-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            sidebar.classList.toggle('materi-sidebar-expanded');
            sidebar.classList.toggle('materi-sidebar-collapsed');
            btnIcon.classList.toggle('rotate-180');

            if (window.innerWidth <= 1200) {
                document.body.classList.toggle('sidebar-visible');
            }
        });

        function checkWidth() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            if (window.innerWidth <= 1024) {
                sidebar.classList.add('sidebar-hidden');
                btnIcon.classList.add('rotate-180');
            } else {
                sidebar.classList.remove('sidebar-hidden');
                btnIcon.classList.remove('rotate-180');
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


    {{-- Float Message for PTK section --}}
    <div id="message"
        class="hidden bg-green-100 fixed top-28 right-5 text-green-800 p-4 rounded-lg transition-all duration-500 transform opacity-0 translate-y-5 scale-95 blur-sm">
    </div>
    <div id="errorMessage"
        class="hidden bg-red-100 fixed top-28 right-5 text-red-800 p-4 rounded-lg transition-all duration-500 transform opacity-0 translate-y-5 scale-95 blur-sm">
    </div>
    <script>
        function showMessage(type, message) {
            if (type === 'success') {
                $('#message').text(message).removeClass('hidden opacity-0 translate-y-5 scale-95 blur-sm')
                    .addClass('opacity-0 translate-y-5 scale-95 blur-sm');

                setTimeout(function() {
                    $('#message').removeClass('opacity-0 translate-y-5 scale-95 blur-sm')
                        .addClass('opacity-100 translate-y-0 scale-100 blur-none');
                }, 10);

                setTimeout(function() {
                    $('#message').removeClass('opacity-100 translate-y-0 scale-100 blur-none')
                        .addClass('opacity-0 translate-y-5 scale-95 blur-sm');
                    setTimeout(function() {
                        $('#message').addClass('hidden');
                    }, 500);
                }, 5000);
            } else if (type === 'error') {
                $('#errorMessage').text(message).removeClass('hidden opacity-0 translate-y-5 scale-95 blur-sm')
                    .addClass('opacity-0 translate-y-5 scale-95 blur-sm');

                setTimeout(function() {
                    $('#errorMessage').removeClass('opacity-0 translate-y-5 scale-95 blur-sm')
                        .addClass('opacity-100 translate-y-0 scale-100 blur-none');
                }, 10);

                setTimeout(function() {
                    $('#errorMessage').removeClass('opacity-100 translate-y-0 scale-100 blur-none')
                        .addClass('opacity-0 translate-y-5 scale-95 blur-sm');
                    setTimeout(function() {
                        $('#errorMessage').addClass('hidden');
                    }, 500);
                }, 5000);
            }
        }

        // Flash message dari Laravel
        $(document).ready(function() {
            @if (session('success'))
                showMessage('success', "{{ session('success') }}");
            @endif

            @if (session('error'))
                showMessage('error', "{{ session('error') }}");
            @endif
        });
    </script>
@endif
