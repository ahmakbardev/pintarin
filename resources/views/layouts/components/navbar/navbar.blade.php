@if (!in_array(Route::currentRouteName(), ['latihan', 'saling-review']))
    <div id="navbar" class="shadow-md sticky top-0 z-50 container-nav flex justify-between items-center bg-primary">
        <div class="breadcrumb text-white flex gap-2 items-center">
            <p>Beranda</p>
            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.99496 10.9955C8.84262 10.9955 11.1931 8.64509 11.1931 5.80246C11.1931 2.95982 8.83759 0.609375 5.98994 0.609375C3.1473 0.609375 0.80188 2.95982 0.80188 5.80246C0.80188 8.64509 3.15233 10.9955 5.99496 10.9955ZM5.99496 9.96094C3.68971 9.96094 1.84652 8.1077 1.84652 5.80246C1.84652 3.49721 3.68971 1.649 5.98994 1.649C8.29518 1.649 10.1484 3.49721 10.1534 5.80246C10.1585 8.1077 8.30021 9.96094 5.99496 9.96094ZM4.86996 8.27846C5.01561 8.42411 5.31192 8.41406 5.46762 8.26339L7.5117 6.33984C7.81806 6.05859 7.81806 5.56138 7.5117 5.28013L5.46762 3.35659C5.29686 3.19587 5.0357 3.19085 4.87498 3.34152C4.6992 3.50725 4.69418 3.7885 4.86494 3.94922L6.84875 5.80748L4.86494 7.67076C4.6992 7.83147 4.69418 8.1077 4.86996 8.27846Z"
                    fill="white" />
            </svg>
            <p class="">Pelatihan</p>
            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.99496 10.9955C8.84262 10.9955 11.1931 8.64509 11.1931 5.80246C11.1931 2.95982 8.83759 0.609375 5.98994 0.609375C3.1473 0.609375 0.80188 2.95982 0.80188 5.80246C0.80188 8.64509 3.15233 10.9955 5.99496 10.9955ZM5.99496 9.96094C3.68971 9.96094 1.84652 8.1077 1.84652 5.80246C1.84652 3.49721 3.68971 1.649 5.98994 1.649C8.29518 1.649 10.1484 3.49721 10.1534 5.80246C10.1585 8.1077 8.30021 9.96094 5.99496 9.96094ZM4.86996 8.27846C5.01561 8.42411 5.31192 8.41406 5.46762 8.26339L7.5117 6.33984C7.81806 6.05859 7.81806 5.56138 7.5117 5.28013L5.46762 3.35659C5.29686 3.19587 5.0357 3.19085 4.87498 3.34152C4.6992 3.50725 4.69418 3.7885 4.86494 3.94922L6.84875 5.80748L4.86494 7.67076C4.6992 7.83147 4.69418 8.1077 4.86996 8.27846Z"
                    fill="white" />
            </svg>
            <p class="font-semibold">Topik</p>
        </div>

        <button id="burger" class="md:hidden flex flex-col gap-1.5 p-3">
            <div class="w-5 h-0.5 bg-white"></div>
            <div class="w-5 h-0.5 bg-white"></div>
            <div class="w-5 h-0.5 bg-white"></div>
        </button>

        <div class="flex items-center gap-3">
            {{-- <div class="hidden md:flex search flex">
                <input type="text"
                    class="py-3 ps-5 rounded-s-full w-64 focus:outline-none focus:ring-1 focus:ring-sky-500"
                    placeholder="cari modul atau materi..">
                <button
                    class="bg-white border-l-2 border-gray w-12 pr-1 flex justify-center items-center rounded-r-full group/btnSearch">
                    <svg class="w-5 h-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.102 14.1189L10.4645 9.48138C11.1841 8.55103 11.5734 7.41353 11.5734 6.2171C11.5734 4.78496 11.0145 3.4421 10.0038 2.4296C8.99306 1.4171 7.64663 0.859955 6.21627 0.859955C4.78592 0.859955 3.43949 1.41888 2.42877 2.4296C1.41627 3.44031 0.859131 4.78496 0.859131 6.2171C0.859131 7.64746 1.41806 8.99388 2.42877 10.0046C3.43949 11.0171 4.78413 11.5742 6.21627 11.5742C7.4127 11.5742 8.54842 11.185 9.47877 10.4671L14.1163 15.1028C14.1299 15.1164 14.146 15.1272 14.1638 15.1346C14.1816 15.1419 14.2006 15.1457 14.2198 15.1457C14.2391 15.1457 14.2581 15.1419 14.2759 15.1346C14.2937 15.1272 14.3098 15.1164 14.3234 15.1028L15.102 14.326C15.1156 14.3124 15.1264 14.2963 15.1338 14.2785C15.1411 14.2607 15.1449 14.2417 15.1449 14.2225C15.1449 14.2032 15.1411 14.1842 15.1338 14.1664C15.1264 14.1486 15.1156 14.1325 15.102 14.1189ZM9.04485 9.04567C8.2877 9.80103 7.28413 10.2171 6.21627 10.2171C5.14842 10.2171 4.14485 9.80103 3.3877 9.04567C2.63235 8.28853 2.21627 7.28496 2.21627 6.2171C2.21627 5.14924 2.63235 4.14388 3.3877 3.38853C4.14485 2.63317 5.14842 2.2171 6.21627 2.2171C7.28413 2.2171 8.28949 2.63138 9.04485 3.38853C9.8002 4.14567 10.2163 5.14924 10.2163 6.2171C10.2163 7.28496 9.8002 8.29031 9.04485 9.04567Z"
                            class="fill-slate-400 group-hover/btnSearch:fill-slate-800 transition-all ease-in-out" />
                    </svg>

                </button>
            </div> --}}
            <!-- Profile and Logout -->
            <div class="relative">
                <button id="profile"
                    class="flex items-center gap-2 ring-0 hover:ring-4 hover:ring-blue-400 transition-all ease-in-out rounded-full">
                    <img src="{{ asset('assets/images/profile/default-profile.png') }}" alt="Profile"
                        class="w-8 h-8 rounded-full">
                    {{-- <span class="text-white">{{ Auth::user()->name }}</span> --}}
                </button>
                <div id="profile-menu"
                    class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl hidden opacity-0 transform translate-y-5 transition-all">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="mobile-menu"
        class="hidden md:hidden bg-primary text-white flex flex-col p-4 absolute top-16 left-0 w-full shadow-md">
        {{-- <div class="search flex mb-4">
            <input type="text"
                class="py-3 ps-5 rounded-s-full w-full focus:outline-none focus:ring-1 focus:ring-sky-500"
                placeholder="cari modul atau materi..">
            <button
                class="bg-white border-l-2 border-gray w-12 pr-1 flex justify-center items-center rounded-r-full group/btnSearch">
                <svg class="w-5 h-5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.102 14.1189L10.4645 9.48138C11.1841 8.55103 11.5734 7.41353 11.5734 6.2171C11.5734 4.78496 11.0145 3.4421 10.0038 2.4296C8.99306 1.4171 7.64663 0.859955 6.21627 0.859955C4.78592 0.859955 3.43949 1.41888 2.42877 2.4296C1.41627 3.44031 0.859131 4.78496 0.859131 6.2171C0.859131 7.64746 1.41806 8.99388 2.42877 10.0046C3.43949 11.0171 4.78413 11.5742 6.21627 11.5742C7.4127 11.5742 8.54842 11.185 9.47877 10.4671L14.1163 15.1028C14.1299 15.1164 14.146 15.1272 14.1638 15.1346C14.1816 15.1419 14.2006 15.1457 14.2198 15.1457C14.2391 15.1457 14.2581 15.1419 14.2759 15.1346C14.2937 15.1272 14.3098 15.1164 14.3234 15.1028L15.102 14.326C15.1156 14.3124 15.1264 14.2963 15.1338 14.2785C15.1411 14.2607 15.1449 14.2417 15.1449 14.2225C15.1449 14.2032 15.1411 14.1842 15.1338 14.1664C15.1264 14.1486 15.1156 14.1325 15.102 14.1189ZM9.04485 9.04567C8.2877 9.80103 7.28413 10.2171 6.21627 10.2171C5.14842 10.2171 4.14485 9.80103 3.3877 9.04567C2.63235 8.28853 2.21627 7.28496 2.21627 6.2171C2.21627 5.14924 2.63235 4.14388 3.3877 3.38853C4.14485 2.63317 5.14842 2.2171 6.21627 2.2171C7.28413 2.2171 8.28949 2.63138 9.04485 3.38853C9.8002 4.14567 10.2163 5.14924 10.2163 6.2171C10.2163 7.28496 9.8002 8.29031 9.04485 9.04567Z"
                        class="fill-slate-400 group-hover/btnSearch:fill-slate-800 transition-all ease-in-out" />
                </svg>
            </button>
        </div> --}}
        <p class="py-2">Beranda</p>
        <p class="py-2">Pelatihan</p>
        <p class="py-2 font-semibold">Topik</p>
        <a href="{{ route('profile') }}" class="py-2 text-gray-800 hover:bg-gray-200">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="py-2 text-left w-full text-gray-800 hover:bg-gray-200">Logout</button>
        </form>
    </div>
@endif

<script>
    document.getElementById('burger').addEventListener('click', function() {
        var mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu.classList.contains('-translate-y-full')) {
            mobileMenu.classList.remove('-translate-y-full');
            mobileMenu.classList.add('translate-y-0');
        } else {
            mobileMenu.classList.add('-translate-y-full');
            mobileMenu.classList.remove('translate-y-0');
        }
    });

    document.getElementById('profile').addEventListener('click', function() {
        var profileMenu = document.getElementById('profile-menu');
        if (profileMenu.classList.contains('hidden')) {
            profileMenu.classList.remove('hidden');
            setTimeout(() => {
                profileMenu.classList.remove('opacity-0', 'translate-y-5');
                profileMenu.classList.add('opacity-100', 'translate-y-0');
            }, 10);
        } else {
            profileMenu.classList.add('opacity-0', 'translate-y-5');
            profileMenu.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => {
                profileMenu.classList.add('hidden');
            }, 300);
        }
    });

    document.addEventListener('click', function(event) {
        var profile = document.getElementById('profile');
        var profileMenu = document.getElementById('profile-menu');
        if (!profile.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.add('opacity-0', 'translate-y-5');
            profileMenu.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => {
                profileMenu.classList.add('hidden');
            }, 300);
        }
    });
</script>

@include('layouts.components.navbar.components.nav-materi')
@include('layouts.components.navbar.components.nav-saling-review')
@include('layouts.components.navbar.components.nav-latihan')
@include('layouts.components.navbar.components.nav-post-test')
