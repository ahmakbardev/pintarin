@extends('layouts.layout')

@section('content')
    <div class="container-index w-full">
        <div class="topik pb-28 pt-20 flex justify-between">
            <div class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 active"
                data-category="prinsip">
                <img class="h-full object-fill" src="{{ asset('assets/icons/prinsip.png') }}" alt="Prinsip Pengajaran">
                <p class="text-center transition-all font-semibold">Prinsip Pengajaran</p>
            </div>
            <div class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 opacity-50"
                data-category="pengembangan">
                <img class="h-full object-fill" src="{{ asset('assets/icons/asesmen.png') }}" alt="Pengembangan Asesmen">
                <p class="text-center transition-all group-hover:font-semibold">Pengembangan Asesmen</p>
            </div>
            <div class="group flex flex-col transition-all transform hover:opacity-100 hover:scale-105 ease-in-out justify-between aspect-square h-40 opacity-50"
                data-category="ptk">
                <img class="h-full object-fill" src="{{ asset('assets/icons/PTK.png') }}" alt="PTK">
                <p class="text-center transition-all group-hover:font-semibold">PTK</p>
            </div>
        </div>

        <div class="modul">
            <h1 class="text-xl col-span-2" id="categoryTitle">Daftar Modul Prinsip Pengembangan</h1>
            <div class="grid grid-cols-2 gap-6 my-4" id="modulContainer">
                <!-- Modul akan dimuat di sini melalui jQuery -->
            </div>
        </div>
    </div>

    <div id="learnMoreModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-8 transition-transform transform scale-95 opacity-0"
                id="modalContent">
                <h2 class="text-xl mb-4">Pelajari Materi PTK</h2>
                <p class="mb-4">Berikut adalah materi penting yang perlu dipahami sebelum mengajukan PTK.</p>
                <button id="closeModal"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Close</button>
            </div>
        </div>
    </div>
    <div id="message"
        class="hidden bg-green-100 fixed top-28 right-5 text-green-800 p-4 rounded-lg transition-all duration-500 transform opacity-0 translate-y-5 scale-95 blur-sm">
    </div>
    <div id="errorMessage"
        class="hidden bg-red-100 fixed top-28 right-5 text-red-800 p-4 rounded-lg transition-all duration-500 transform opacity-0 translate-y-5 scale-95 blur-sm">
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function updateFileName(input) {
            const fileName = input.files.length > 0 ? input.files[0].name : 'Berkas kosong';
            document.getElementById('fileName').textContent = fileName;
        }

        $(document).ready(function() {
            // Load default category "prinsip" on page load
            fetchModuls('prinsip');
            setActiveCategory('prinsip');
            // Example variable from backend
            var judulProposalStatus = @json($judulProposalStatus);

            // Handle category clicks
            $('.group').on('click', function() {
                const category = $(this).data('category');
                updateGridColumns(category);
                updateTitle(category);
                showSkeleton(category);
                setActiveCategory(category);
                if (category === 'ptk') {
                    // Special PTK page layout using Tailwind
                    setTimeout(function() { // Simulate loading delay
                        if (judulProposalStatus.judul_ada && judulProposalStatus.proposal_ada) {
                            // User sudah memiliki judul dan proposal
                            $('#modulContainer').html(`
                                <div class="bg-white shadow-md rounded-lg p-6">
                                    <h1 class="text-xl col-span-2 font-medium mb-4" id="categoryTitle">Lihat Status Proposal PTK</h1>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">Judul PTK:</label>
                                        <p class="block w-full pb-2 underline text-lg font-semibold bg-gray-100">${judulProposalStatus.judul}</p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status Proposal:</label>
                                        <p class="block w-full pb-2 underline text-lg font-semibold bg-gray-100">${judulProposalStatus.proposal_status}</p>
                                    </div>
                                    <div class="mb-4 flex">
                                        <a href="{{ route('PTK-judul') }}" class="bg-blue-500 w-full text-center hover:bg-blue-700 text-white font-bold py-2 rounded">Lihat Status Proposal</a>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#modulContainer').html(`
                                <button id="pelajariMateriBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pelajari Materi</button>
                                <div id="modalPTK" class="fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center invisible opacity-0 transition-opacity duration-500 ease-out">
                                    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col transform w-full lg:mx-20 h-full max-h-[95vh] scale-95 opacity-0 blur-sm transition-transform transition-opacity duration-500 ease-out">
                                        <h2 class="text-2xl font-bold mb-4 flex-none">Materi PTK</h2>
                                        <p class="mb-4 flex-none">Pelajari materi terkait PTK sebelum melanjutkan.</p>
                                        <!-- Embed PDF -->
                                        <div id="pdfContainer" class="mb-4 flex-1 relative">
                                            <div id="loadingOverlay" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center hidden">
                                                <p class="text-lg font-semibold">Loading PDF...</p>
                                            </div>
                                            <embed id="pdfEmbed" src="{{ asset('assets/pdf/CARA_MUDAH_MENGUASAI_PTK _B_Dwi.pdf') }}" class="h-full" type="application/pdf" width="100%" />
                                        </div>

                                        <!-- Check to confirm understanding -->
                                        <div class="mb-4 flex-none">
                                            <input type="checkbox" id="understoodCheck" class="mr-2">
                                            <label for="understoodCheck" class="text-sm">Saya sudah memahami materi ini</label>
                                        </div>

                                        <!-- Next or Finish button -->
                                        <div class="flex justify-between">
                                            <button id="nextBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
                                            <button id="finishBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded hidden">Selesai</button>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }

                        applySmoothTransition();

                        // PDF list and current index
                        const pdfList = [
                            "{{ asset('assets/pdf/CARA_MUDAH_MENGUASAI_PTK _B_Dwi.pdf') }}",
                            "{{ asset('assets/pdf/PPT_Penelitian_Tindakan_Kelas_Hayuni_Retno.pdf') }}",
                        ];
                        let currentIndex = 0;

                        // Show modal on button click
                        $('#pelajariMateriBtn').on('click', function() {
                            $('#modalPTK').removeClass('invisible opacity-0').addClass(
                                'opacity-100');
                            $('#modalPTK div').removeClass('scale-95 opacity-0 blur-sm')
                                .addClass('scale-100 opacity-100 blur-none');
                        });

                        // Handle Next button click
                        $('#nextBtn').on('click', function() {
                            if (!$('#understoodCheck').is(':checked')) {
                                alert(
                                    'Harap centang "Saya sudah memahami materi ini" sebelum melanjutkan.'
                                );
                                return;
                            }

                            // Show loading overlay
                            $('#loadingOverlay').removeClass('hidden');

                            // Simulate loading time for PDF (optional)
                            setTimeout(function() {
                                currentIndex++;

                                if (currentIndex < pdfList.length - 1) {
                                    // Load the next PDF
                                    $('#pdfEmbed').attr('src', pdfList[
                                        currentIndex]);
                                    $('#understoodCheck').prop('checked',
                                        false); // Uncheck the checkbox
                                } else if (currentIndex === pdfList.length - 1) {
                                    // Last PDF, show "Selesai" button
                                    $('#pdfEmbed').attr('src', pdfList[
                                        currentIndex]);
                                    $('#nextBtn').addClass('hidden');
                                    $('#finishBtn').removeClass('hidden');
                                    $('#understoodCheck').prop('checked',
                                        false); // Uncheck the checkbox
                                }

                                // Hide loading overlay after loading
                                $('#loadingOverlay').addClass('hidden');
                            }, 1000); // Simulate 1-second loading delay
                        });

                        // Handle Finish button click
                        // Handle Finish button click
                        $('#finishBtn').on('click', function() {
                            // Transition out the modal
                            $('#modalPTK div').removeClass(
                                'scale-100 opacity-100 blur-none').addClass(
                                'scale-95 opacity-0 blur-sm');

                            setTimeout(function() {
                                // Hide modal
                                $('#modalPTK').removeClass('opacity-100').addClass(
                                    'opacity-0 invisible');

                                $('#modulContainer').html(`
                                    <div class="bg-white shadow-md rounded-lg p-6">
                                        <h1 class="text-xl col-span-2 font-medium mb-4" id="categoryTitle">Ajukan Judul PTK</h1>
                                        <form id="judulProposalForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-4">
                                                <input type="text" name="judul" placeholder="Judul"
                                                    class="block w-full px-3 py-2 border border-grayScale-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                            </div>
                                            <div class="grid grid-cols-2 gap-4 mb-4">
                                                <div>
                                                    <label class="block text-grayScale-700 text-sm font-bold mb-2" for="dosen">
                                                        Dosen Pembimbing
                                                    </label>
                                                    <input type="text" id="dosen" value="{{ $dosen->name ?? 'Dosen tidak ditemukan' }}" readonly
                                                        class="block w-full text-grayScale-300 px-3 py-2 border border-grayScale-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>
                                                <div>
                                                    <label class="block text-grayScale-700 text-sm font-bold mb-2" for="unggahBerkas">
                                                        Unggah Berkas
                                                    </label>
                                                    <div class="flex items-center border border-grayScale-300 rounded-md overflow-hidden">
                                                        <label class="bg-blue-500 text-white px-4 py-2 cursor-pointer hover:bg-blue-700" for="unggahBerkas">Pilih</label>
                                                        <input type="file" id="unggahBerkas" name="file" class="hidden" onchange="updateFileName(this)">
                                                        <span id="fileName" class="pl-3 text-grayScale-500">Berkas kosong</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 flex">
                                                <button type="submit" id="submitProposal" class="bg-blue-500 w-full text-center hover:bg-blue-700 text-white font-bold py-2 rounded">Submit Proposal</button>
                                            </div>
                                        </form>
                                    </div>

                                    `);

                                $(document).on('submit', '#judulProposalForm',
                                    function(e) {
                                        e
                                            .preventDefault(); // Mencegah pengiriman form secara default

                                        var formData = new FormData(
                                            this
                                        ); // Membuat FormData untuk menangani file dan input
                                        $.ajax({
                                            url: "{{ route('ptk.submitJudulProposal') }}", // Route yang sudah kamu buat untuk submit
                                            type: "POST",
                                            data: formData,
                                            contentType: false, // Mengatur agar jQuery tidak memproses data
                                            processData: false, // Mengatur agar jQuery tidak memproses form menjadi string
                                            success: function(
                                                response) {
                                                showMessage(
                                                    'success',
                                                    response
                                                    .message
                                                ); // Show success message
                                                $('#judulProposalForm')[
                                                    0].reset();
                                                $('#fileName').text(
                                                    'Berkas kosong'
                                                );

                                                // Redirect ke halaman '/PTK-judul' setelah beberapa saat
                                                setTimeout(
                                                    function() {
                                                        window
                                                            .location
                                                            .href =
                                                            "{{ route('PTK-judul') }}"; // Arahkan ke route PTK-judul
                                                    },
                                                    1500
                                                ); // Tunggu 1.5 detik sebelum redirect
                                            },
                                            error: function(xhr) {
                                                showMessage('error',
                                                    xhr
                                                    .responseJSON
                                                    .message
                                                ); // Show error message
                                            }

                                        });
                                    });

                                function showMessage(type, message) {
                                    if (type === 'success') {
                                        $('#message').text(message).removeClass(
                                                'hidden')
                                            .removeClass(
                                                'opacity-0 translate-y-5 scale-95 blur-sm'
                                            ) // Start hidden state
                                            .addClass(
                                                'opacity-0 translate-y-5 scale-95 blur-sm'
                                            ); // Ensure it starts from hidden state
                                        setTimeout(function() {
                                                $('#message').removeClass(
                                                        'opacity-0 translate-y-5 scale-95 blur-sm'
                                                    ) // Remove hidden state
                                                    .addClass(
                                                        'opacity-100 translate-y-0 scale-100 blur-none'
                                                    ); // Show with transition
                                            },
                                            10
                                        ); // Add small delay to allow transition to take effect
                                        setTimeout(function() {
                                            $('#message').removeClass(
                                                    'opacity-100 translate-y-0 scale-100 blur-none'
                                                )
                                                .addClass(
                                                    'opacity-0 translate-y-5 scale-95 blur-sm'
                                                ); // Hide with transition
                                            setTimeout(function() {
                                                    $('#message')
                                                        .addClass(
                                                            'hidden'
                                                        ); // Fully hide after transition
                                                },
                                                500
                                            ); // Delay to match the transition duration
                                        }, 5000); // 5 seconds visible before hide
                                    } else if (type === 'error') {
                                        $('#errorMessage').text(message)
                                            .removeClass('hidden')
                                            .removeClass(
                                                'opacity-0 translate-y-5 scale-95 blur-sm'
                                            ) // Start hidden state
                                            .addClass(
                                                'opacity-0 translate-y-5 scale-95 blur-sm'
                                            ); // Ensure it starts from hidden state
                                        setTimeout(function() {
                                                $('#errorMessage').removeClass(
                                                        'opacity-0 translate-y-5 scale-95 blur-sm'
                                                    )
                                                    .addClass(
                                                        'opacity-100 translate-y-0 scale-100 blur-none'
                                                    ); // Show with transition
                                            },
                                            10
                                        ); // Add small delay to allow transition to take effect
                                        setTimeout(function() {
                                            $('#errorMessage').removeClass(
                                                    'opacity-100 translate-y-0 scale-100 blur-none'
                                                )
                                                .addClass(
                                                    'opacity-0 translate-y-5 scale-95 blur-sm'
                                                ); // Hide with transition
                                            setTimeout(function() {
                                                    $('#errorMessage')
                                                        .addClass(
                                                            'hidden'
                                                        ); // Fully hide after transition
                                                },
                                                500
                                            ); // Delay to match the transition duration
                                        }, 5000); // 5 seconds visible before hide
                                    }
                                }


                                // Apply transition to the form container
                                applySmoothTransition();
                            }, 500); // Delay for smooth transition effect
                        });

                    }, 1000); // Simulate a 1 second delay
                } else {
                    fetchModuls(category);
                }
            });

            function fetchModuls(category) {
                $.ajax({
                    url: `/moduls/${category}`,
                    type: 'GET',
                    success: function(moduls) {
                        if (category !== 'ptk') {
                            updateGridColumns('default');
                        }
                        $('#modulContainer').empty();
                        if (moduls.length === 0) {
                            $('#modulContainer').append('<p class="text-center">No modules found.</p>');
                        } else {
                            moduls.forEach(modul => {
                                const progressPercentage = modul.total_materi > 0 ? (modul
                                    .completed_materi / modul.total_materi) * 100 : 0;
                                const modulHtml = `
                                    <a href="/modul/${modul.id}" class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex justify-between items-center transform scale-95 opacity-0 transition-transform duration-500 ease-out">
                                        <div class="flex gap-5 w-3/4">
                                            <img class="w-16" src="{{ asset('assets/icons/modul-1.png') }}" alt="">
                                            <div class="flex flex-col w-full">
                                                <p class="text-xs">Modul</p>
                                                <p class="text-lg">${modul.name}</p>
                                                <div class="w-full bg-grayScale-200 rounded-full h-2 dark:bg-grayScale-300 mt-2">
                                                    <div class="bg-blue-600 h-2 rounded-full" style="width: ${progressPercentage}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-grayScale-500">${modul.completed_materi}/${modul.total_materi} materi</p>
                                        </div>
                                    </a>
                                `;
                                $('#modulContainer').append(modulHtml);
                            });
                            applySmoothTransition();
                        }
                    },
                    error: function(error) {
                        console.log('Error fetching modules: ', error);
                    }
                });
            }

            function setActiveCategory(category) {
                $('.group').removeClass('active opacity-100').addClass('opacity-50');
                $(`div[data-category="${category}"]`).removeClass('opacity-50').addClass('active opacity-100');
            }

            function updateGridColumns(category) {
                if (category === 'ptk') {
                    $('#modulContainer').removeClass('grid-cols-2').addClass('grid-cols-1');
                } else {
                    $('#modulContainer').removeClass('grid-cols-1').addClass('grid-cols-2');
                }
            }

            function updateTitle(category) {
                let title = "";
                switch (category) {
                    case 'prinsip':
                        title = "Daftar Modul Prinsip Pengembangan";
                        break;
                    case 'pengembangan':
                        title = "Daftar Modul Pengembangan Asesmen";
                        break;
                    case 'ptk':
                        title = "Selamat datang di PTK";
                        break;
                }
                $('#categoryTitle').text(title);
            }

            function showSkeleton(category) {
                $('#modulContainer').removeClass('grid-cols-2').addClass('grid-cols-1').html(`
                    <div class="animate-pulse h-24 bg-grayScale-300 rounded-xl"></div>
                `);
            }

            function applySmoothTransition() {
                setTimeout(() => {
                    $('#modulContainer .transform').removeClass('scale-95 opacity-0').addClass(
                        'scale-100 opacity-100');
                }, 100); // Delay to allow the DOM to update before starting the animation
            }
        });
    </script>

    <style>
        .group.active {
            opacity: 1 !important;
            transform: scale(1.05);
        }

        #modalPTK div {
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
        }

        #modalPTK.hidden div {
            transform: scale(0.95);
            opacity: 0;
        }
    </style>
@endsection
