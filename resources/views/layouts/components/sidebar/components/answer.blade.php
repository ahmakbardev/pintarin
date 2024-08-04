@if (in_array(Route::currentRouteName(), ['answer']))
    <div id="sidebar" class="shadow-md sticky top-24 z-40 px-12 bg-blackMain latihan-sidebar-expanded">
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
        <div class="sticky top-24 py-10 h-[55.1rem] flex flex-col justify-between">
            <div class="flex flex-col gap-10">
                <div class="flex flex-col p-3 ring-2 ring-primary bg-white rounded-xl">
                    <div class="flex flex-col gap-4">
                        <div class="">
                            <p>Nilai</p>
                            <h1 class="text-6xl font-medium text-primary">40</h1>
                        </div>
                        <div class="">
                            <p>Jawaban Benar</p>
                            <h3 class="text-3xl font-medium text-slate-400"><span class="text-primary">4 </span>/ 10</h3>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-5 lg:grid-cols-4 2xl:grid-cols-5 gap-3">
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg>
                        <p class="text-primary font-semibold">1</p>
                    </div>
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#FF5449" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#FF5449" />
                        </svg>
                        <p>2</p>
                    </div>
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg>
                        <p>3</p>
                    </div>
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#FF5449" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#FF5449" />
                        </svg>
                        <p>4</p>
                    </div>
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg>
                        <p>5</p>
                    </div>
                    <div class="bg-white py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative">
                        <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg> <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                        </svg>
                        <p>6</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-[6.5rem] relative">
                <!-- Item pertama -->
                <div class="flex flex-col gap-3 relative">
                    <div class="grid grid-cols-5 gap-3 items-center">
                        <div class="bg-white py-2 rounded-lg flex flex-col gap-1 items-center relative">
                            <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 20L0 0H22V20Z" fill="#70E000" />
                            </svg>

                            <p class="text-transparent">6</p>
                        </div>
                        <div class="col-span-4 text-white">Benar</div>
                    </div>
                    <div class="grid grid-cols-5 gap-3 items-center">
                        <div class="bg-white py-2 rounded-lg flex flex-col gap-1 items-center relative">
                            <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 20L0 0H22V20Z" fill="#FF5449" />
                            </svg>
                            <p class="text-transparent">6</p>
                        </div>
                        <div class="col-span-4 text-white">Salah</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-sidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            sidebar.classList.toggle('latihan-sidebar-expanded');
            sidebar.classList.toggle('latihan-sidebar-collapsed');
            btnIcon.classList.toggle('own-rotate-180');

            // Additional logic for sidebar visibility on small screens
            if (window.innerWidth <= 1024) {
                document.body.classList.toggle('sidebar-visible');
            }
        });

        // Additional logic for responsive sidebar
        function checkWidth() {
            var sidebar = document.getElementById('sidebar');
            var btnIcon = document.getElementById('btn-icon');
            if (window.innerWidth <= 1024) {
                sidebar.classList.add('sidebar-hidden');
                btnIcon.classList.add('own-rotate-180'); // Set icon rotation by default on small screens
            } else {
                sidebar.classList.remove('sidebar-hidden');
                btnIcon.classList.remove('own-rotate-180'); // Reset icon rotation on larger screens
            }

            // Ensure feature and text-feature are visible below 1024px width
            if (window.innerWidth <= 1024) {
                var features = document.querySelectorAll('.feature, .text-feature');
                features.forEach(function(feature) {
                    feature.style.display = 'inline'; // Ensure visibility
                    feature.classList.add('text-center'); // Add additional styles if necessary
                });
            } else {
                var features = document.querySelectorAll('.feature, .text-feature');
                features.forEach(function(feature) {
                    feature.style.display = ''; // Reset visibility
                    feature.classList.remove('text-center'); // Remove additional styles if necessary
                });
            }
        }

        // Initial check
        checkWidth();

        // Check on resize
        window.addEventListener('resize', checkWidth);
    </script>
@endif
