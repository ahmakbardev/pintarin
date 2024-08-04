@extends('layouts.layout')

@section('content')
    <div class="materi-content relative grid grid-cols-3 w-full gap-5 py-5">
        <div class="h-fit sticky top-28 flex flex-col gap-5">
            <div class="bg-white py-6 px-6 rounded-lg shadow-md">
                <div class="flex flex-col items-center w-full gap-5">
                    <img src="{{ asset('assets/images/profile/default-profile.png') }}"
                        class="w-20 aspect-square rounded-full" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-medium text-center">Itamara Shofinia Weladis Aini</h1>
                        <div class="flex flex-col gap-2">
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>NIM</p>
                                </div>
                                <p>: 200535626862</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>Dosen PA</p>
                                </div>
                                <p>: Dyah Lestari, S.T., M.Eng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="post-test-container"
                class="bg-white py-6 px-6 rounded-lg shadow-lg flex flex-col gap-4 transition-all duration-300 transform">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl">Post Test 1</h1>
                        <h4 class="text-base">Modul Pemimpin yang Memberdayakan</h4>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        @foreach ($tugasProgressList as $index => $progress)
                            <div id="pdf-{{ $index }}"
                                onclick="embedFile('{{ asset('storage/' . $progress->pdf_path) }}', 'application/pdf', 'pdf-{{ $index }}', 'ppt-{{ $index }}')"
                                class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center cursor-pointer hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info">
                                <img src="{{ asset('assets/icons/PDF.png') }}" class="w-10 aspect-square object-cover"
                                    alt="">
                                <div class="group-hover:font-medium">Lihat PDF</div>
                            </div>
                            <div id="ppt-{{ $index }}"
                                onclick="embedFile('https://docs.google.com/gview?url={{ asset('storage/' . $progress->ppt_path) }}&embedded=true', 'application/vnd.ms-powerpoint', 'ppt-{{ $index }}', 'pdf-{{ $index }}')"
                                class="bg-info-50 rounded-xl py-4 flex flex-col gap-6 items-center cursor-pointer hover:scale-105 transition-all ease-in-out group hover:ring-1 hover:ring-inset hover:ring-info-400">
                                <img src="{{ asset('assets/icons/PPT.png') }}" class="w-10 aspect-square object-cover"
                                    alt="">
                                <div class="group-hover:font-medium">Lihat PPT</div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <button id="toggle-review" class="bg-primary text-white py-4 px-14 rounded-xl font-medium">Lihat Review</button>
        </div>
        <div id="main-content" class="col-span-2 flex flex-col gap-5 relative">
            <div class="bg-white flex flex-col gap-4 py-6 px-6 rounded-lg shadow-lg">
                <div class="w-full h-full rounded-lg">
                    <embed id="file-embed" src="#" type="application/pdf" width="100%"
                        class="rounded-lg h-screen max-h-screen" />
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/pptx2html"></script>

        <script>
            var originalContent = document.getElementById('post-test-container').innerHTML;
            var postTestContainer = document.getElementById('post-test-container');
            var toggleButton = document.getElementById('toggle-review');


            document.addEventListener('DOMContentLoaded', function() {
                // Set the default PDF to be displayed
                @if (count($tugasProgressList) > 0)
                    var defaultPdfPath = '{{ asset('storage/' . $tugasProgressList[0]->pdf_path) }}';
                    embedFile(defaultPdfPath, 'application/pdf', 'pdf-0', 'ppt-0');
                @endif
            });

            function embedFile(filePath, fileType, activePdfId, activePptId) {
                var fileEmbed = document.getElementById('file-embed');

                // Remove active class from all items
                document.querySelectorAll('.bg-info-50').forEach(function(element) {
                    element.classList.remove('ring-2', 'ring-primary');
                });

                // Add active class to the clicked item
                document.getElementById(activePdfId).classList.add('ring-2', 'ring-primary');
                document.getElementById(activePptId).classList.add('ring-2', 'ring-primary');

                if (fileType === 'application/vnd.ms-powerpoint') {
                    // Use an online viewer for PPT
                    var pptViewerUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(filePath);
                    fileEmbed.src = pptViewerUrl;
                    fileEmbed.type = '';
                } else {
                    // Use default embedding for PDF
                    fileEmbed.src = filePath;
                    fileEmbed.type = fileType;
                }
            }

            function toggleContent() {
                if (toggleButton.innerText === 'Lihat Review') {
                    postTestContainer.classList.add('opacity-0', 'blur-md', '-translate-y-10');
                    setTimeout(function() {
                        postTestContainer.innerHTML = `
                            <div class="flex flex-col gap-5 transition-all duration-300 transform opacity-0 translate-y-10">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-xl">Diskusi</h1>
                                </div>
                                <div id="chat-review" class="bg-white flex flex-col gap-4 py-3 px-6 rounded-lg ring-1 ring-info-100"
                                    data-simplebar style="max-height: 400px;">
                                    @for ($i = 0; $i < 5; $i++)
                                    <div class="flex gap-2 items-center">
                                        <img src="{{ asset('assets/images/profile/profile-2.png') }}" class="w-8 h-8 rounded-full object-cover">
                                        <div class="bg-white flex flex-col gap-px px-4 py-1 rounded-lg shadow-md my-3 w-fit">
                                            <h4 class="text-sm font-medium">Akbar</h4>
                                            <p class="text-xs">Pesan akan muncul disini {{ $i + 1 }}</p>
                                        </div>
                                    </div>
                                    @endfor
                                    <div class="flex gap-2 items-center ml-auto w-fit">
                                        <div class="bg-info-50 flex flex-col gap-px px-4 py-1 rounded-lg shadow-md my-3 w-fit">
                                            <h4 class="text-sm font-medium">Akbar</h4>
                                            <p class="text-xs">Pesan terakhir akan muncul disini</p>
                                        </div>
                                        <img src="{{ asset('assets/images/profile/profile-2.png') }}" class="w-8 h-8 rounded-full object-cover">
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <textarea id="chat-input" rows="1"
                                        class="py-3 px-4 border w-full border-slate-300 text-xs rounded-xl outline-none focus:ring-1 focus:ring-inset focus:ring-primary transition-all ease-in-out hover:ring-1 hover:ring-blue-300 hover:ring-inset"
                                        placeholder="Tulis pesan kamu disini" style="resize: none"></textarea>
                                    <button id="send-chat" class="bg-primary text-white py-4 px-10 rounded-xl font-medium">Kirim</button>
                                </div>
                            </div>
                        `;
                        setTimeout(function() {
                            postTestContainer.classList.remove('opacity-0', 'blur-md', '-translate-y-10');
                            postTestContainer.classList.add('opacity-100', 'translate-y-0');
                            document.querySelector('#post-test-container .transform').classList.remove(
                                'opacity-0', 'translate-y-10');
                            document.querySelector('#post-test-container .transform').classList.add(
                                'opacity-100', 'translate-y-0');
                        }, 50); // small delay to ensure the transition is visible
                        toggleButton.innerText = 'Tutup Review';

                        document.getElementById('send-chat').addEventListener('click', function() {
                            var chatInput = document.getElementById('chat-input');
                            var chatReview = document.getElementById('chat-review');

                            if (chatInput.value.trim() !== '') {
                                var messageDiv = document.createElement('div');
                                messageDiv.classList.add('bg-info-50', 'flex', 'ml-auto', 'flex-col',
                                    'gap-2',
                                    'px-4',
                                    'py-2', 'rounded-lg', 'shadow-md', 'w-fit');
                                messageDiv.innerHTML =
                                    `<h4 class="text-base font-medium">Akbar <span class="text-xs text-grayScale-300 ml-3">Just now</span></h4><p class="text-sm">${chatInput.value}</p>`;
                                chatReview.appendChild(messageDiv);

                                chatInput.value = '';
                                chatReview.scrollTop = chatReview.scrollHeight;
                            }
                        });
                    }, 300); // duration should match transition duration
                } else {
                    postTestContainer.classList.add('opacity-0', 'blur-md', '-translate-y-10');
                    setTimeout(function() {
                        postTestContainer.innerHTML = originalContent; // Revert back to the original content
                        postTestContainer.classList.remove('opacity-0', 'blur-md', '-translate-y-10');
                        postTestContainer.classList.add('opacity-100', 'translate-y-0');
                    }, 300); // duration should match transition duration
                    toggleButton.innerText = 'Lihat Review';
                }
            }

            toggleButton.addEventListener('click', toggleContent);
        </script>
    </div>
@endsection
