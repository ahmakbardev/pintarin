@extends('layouts.layout')

@section('content')
    <div class="materi-content relative grid grid-cols-3 w-full gap-5 py-5">
        <div class="h-fit sticky top-28 flex flex-col gap-5">
            <div class="bg-white py-6 px-6 rounded-lg shadow-md">
                <div class="flex flex-col items-center w-full gap-5">
                    <img src="{{ asset('assets/images/profile/default-profile.png') }}"
                        class="w-20 aspect-square rounded-full" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-medium text-center">{{ $user->name }}</h1>
                        <div class="flex flex-col gap-2">
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>NIM</p>
                                </div>
                                <p>: {{ $user->nim }}</p>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="flex gap-3">
                                    <img src="{{ asset('assets/icons/school.svg') }}" alt="">
                                    <p>Dosen PA</p>
                                </div>
                                <p>: {{ $user->dosen->name }}</p>
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

        <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.min.css" />
        <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pptx2html"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            var originalContent = document.getElementById('post-test-container').innerHTML;
            var postTestContainer = document.getElementById('post-test-container');
            var toggleButton = document.getElementById('toggle-review');

            $(document).ready(function() {
                @if (count($tugasProgressList) > 0)
                    var defaultPdfPath = '{{ asset('storage/' . $tugasProgressList[0]->pdf_path) }}';
                    embedFile(defaultPdfPath, 'application/pdf', 'pdf-0', 'ppt-0');
                @endif
            });

            function embedFile(filePath, fileType, activePdfId, activePptId) {
                var fileEmbed = document.getElementById('file-embed');
                document.querySelectorAll('.bg-info-50').forEach(function(element) {
                    element.classList.remove('ring-2', 'ring-primary');
                });
                document.getElementById(activePdfId).classList.add('ring-2', 'ring-primary');
                document.getElementById(activePptId).classList.add('ring-2', 'ring-primary');

                if (fileType === 'application/vnd.ms-powerpoint') {
                    var pptViewerUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' + encodeURIComponent(filePath);
                    fileEmbed.src = pptViewerUrl;
                    fileEmbed.type = '';
                } else {
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
                                <div id="chat-review" class="bg-white flex flex-col gap-4 py-3 px-6 rounded-lg ring-1 ring-info-100 w-full overflow-y-auto"
                                    style="max-height: 400px;">
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
                        }, 50);
                        toggleButton.innerText = 'Tutup Review';

                        initializeChat();
                    }, 300);
                } else {
                    postTestContainer.classList.add('opacity-0', 'blur-md', '-translate-y-10');
                    setTimeout(function() {
                        postTestContainer.innerHTML = originalContent;
                        postTestContainer.classList.remove('opacity-0', 'blur-md', '-translate-y-10');
                        postTestContainer.classList.add('opacity-100', 'translate-y-0');
                    }, 300);
                    toggleButton.innerText = 'Lihat Review';
                }
            }

            function initializeChat() {
                const progressId = {{ $tugasProgress->id }};
                const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                });

                const channel = pusher.subscribe(`saling-review.${progressId}`);
                const chatReview = $('#chat-review');

                // Fetch existing messages with jQuery AJAX
                fetchMessages(progressId);

                channel.bind('App\\Events\\SalingReviewMessageSent', function(data) {
                    appendMessage(data.message, data.user_name, data.created_at, data.user_id);
                });

                $('#send-chat').on('click', function() {
                    const message = $('#chat-input').val();
                    if (!message.trim()) return;

                    $.post('{{ route('send-review-message') }}', {
                        message: message,
                        progress_id: progressId,
                        _token: '{{ csrf_token() }}'
                    }, function() {
                        $('#chat-input').val('');
                    });
                });
            }

            function appendMessage(message, userName, createdAt, userId) {
                const isCurrentUser = userId === {{ Auth::id() }};
                const messageClass = isCurrentUser ? 'bg-info-50' : 'bg-white';
                const alignmentClass = isCurrentUser ? 'ml-auto' : 'mr-auto';
                const chatReview = $('#chat-review');

                const messageDiv = $(`
        <div class="flex ${alignmentClass} w-fit">
            <div class="${messageClass} flex flex-col gap-px px-4 py-2 rounded-lg shadow-md my-1 overflow-hidden">
                <h4 class="text-sm font-medium">${userName} <span class="text-xs text-gray-400">${createdAt}</span></h4>
                <p class="text-xs">${message}</p>
            </div>
        </div>
    `);
                chatReview.append(messageDiv);
                chatReview.scrollTop(chatReview.prop('scrollHeight')); // Scroll otomatis ke bawah
            }

            function fetchMessages(progressId) {
                $.get(`/fetch-review-messages/${progressId}`, function(messages) {
                    const chatReview = $('#chat-review');
                    chatReview.empty();
                    messages.forEach(function(message) {
                        appendMessage(message.message, message.user_name, message.created_at, message.user_id);
                    });
                });
            }

            toggleButton.addEventListener('click', toggleContent);
        </script>

    </div>
@endsection
