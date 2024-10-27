@extends('layouts.layout')

@section('content')
    <div class="container-index w-full">
        <div class="modul">
            <h1 class="text-xl">Daftar Materi Modul {{ $modul->name }}</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 my-4">
                @foreach ($materis as $materi)
                    <a href="{{ route('materi', ['id' => $materi->id]) }}"
                        class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                        <img class="w-16" src="{{ asset('assets/icons/modul-1.png') }}" alt="">
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Materi {{ $loop->iteration }}</p>
                            <p class="text-lg">{{ $materi->title }}</p>
                            <div class="flex items-center mt-2">
                                <div class="w-2/3 bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-primary h-2.5 rounded-full"
                                        style="width: {{ in_array($materi->id, $completedMateriIds) ? '100%' : '0%' }}">
                                    </div>
                                </div>
                                <p class="text-base ml-4">{{ in_array($materi->id, $completedMateriIds) ? '100%' : '0%' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="post-test">
            <h1 class="text-xl">Post-Test</h1>
            <div class="grid grid-cols-2 gap-6 my-4">
                @if ($allMateriCompleted)
                    @foreach ($postTests->groupBy('modul_id') as $modulId => $postTestGroup)
                        @foreach ($postTestGroup as $postTest)
                            @if ($postTestScore !== null)
                                <div class="shadow py-7 px-8 rounded-2xl flex gap-5 items-center bg-gray-100">
                                    <img class="w-16" src="{{ asset('assets/icons/post-test.png') }}" alt="">
                                    <div class="flex flex-col w-full">
                                        <p class="text-xs">Post Test {{ $loop->parent->iteration }}</p>
                                        <p class="text-lg">{{ $postTest->question }}</p>
                                        <p class="text-green-500">Nilai: {{ $postTestScore }}</p>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('post-test', ['modulId' => $modul->id, 'id' => $postTest->id]) }}"
                                    class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                                    <img class="w-16" src="{{ asset('assets/icons/post-test.png') }}" alt="">
                                    <div class="flex flex-col w-full">
                                        <p class="text-xs">Post Test {{ $loop->parent->iteration }}</p>
                                        <p class="text-lg">{{ $postTest->question }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <div
                        class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                        <div class="relative">
                            <img class="w-16 opacity-50" src="{{ asset('assets/icons/post-test.png') }}" alt="">
                            <img src="{{ asset('assets/icons/lock.png') }}"
                                class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2" alt="">
                        </div>
                        <div class="flex flex-col w-full">
                            <p class="text-xs">Post Test</p>
                            <p class="text-lg">Pelajari materi di atas terlebih dahulu!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="tugas">
            <h1 class="text-xl">Tugas</h1>
            <div class="grid grid-cols-2 gap-6 my-4">
                @foreach ($tasks as $task)
                    @if ($postTestScore !== null)
                        <a href="{{ route('task', ['id' => $task->id]) }}"
                            class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                            <img class="w-16" src="{{ asset('assets/icons/post-test.png') }}" alt="">
                            <div class="flex flex-col w-full">
                                <p class="text-xs">Tugas {{ $loop->iteration }}</p>
                                <p class="text-lg">{{ $task->title }}</p>
                            </div>
                        </a>
                    @else
                        <div
                            class="shadow hover:ring-1 hover:ring-primary transition-all ease-in-out py-7 px-8 rounded-2xl flex gap-5">
                            <div class="relative">
                                <img class="w-16 opacity-50" src="{{ asset('assets/icons/task.png') }}" alt="">
                                <img src="{{ asset('assets/icons/lock.png') }}"
                                    class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2" alt="">
                            </div>
                            <div class="flex flex-col w-full">
                                <p class="text-xs">Tugas {{ $loop->iteration }}</p>
                                <p class="text-lg">Selesaikan post-test terlebih dahulu!</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="saling-review">
            <h1 class="text-xl">Saling Review</h1>
            <div class="grid grid-cols-3 gap-6 my-4">
                @foreach ($users as $user)
                    <a href="{{ route('saling-review', ['userId' => $user->id]) }}"
                        class="py-3 shadow flex justify-center rounded-xl ring-1 ring-primary hover:bg-primary group transition-all ease-in-out hover:cursor-pointer">
                        <p class="w-2/3 text-nowrap truncate text-center text-primary group-hover:text-white">
                            {{ $user->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="diskusi">
            <h1 class="text-xl">Diskusi dengan Dosen</h1>
            <textarea name="komentar" class="border mt-5 mb-2 p-5 border-gray rounded-xl w-full" style="resize: none"
                id="komentarTextarea" placeholder="Silahkan ketik komentar Anda..." rows="5"></textarea>
            <button id="kirimKomentarButton" class="bg-primary rounded-full w-full py-2 text-white mb-5">Kirim</button>
        </div>
    </div>

    <!-- Modal -->
    <div id="komentarModal"
        class="fixed inset-0 bg-gray-800 bg-opacity-50 backdrop-blur-sm hidden justify-center items-center transition-all ease-in-out duration-300">
        <div
            class="bg-white rounded-lg p-6 w-full max-w-2xl transform transition ease-in-out duration-300 translate-y-10 opacity-0 scale-95">
            <h2 class="text-xl font-semibold mb-4">Komentar Anda</h2>
            <div id="komentarContainer" class="overflow-y-auto max-h-64 mb-4" data-simplebar></div>
            <div class="flex gap-2">
                <textarea id="modalKomentarTextarea" class="border p-2 flex-grow rounded-md" placeholder="Ketik komentar Anda..."></textarea>
                <button id="modalKirimKomentarButton" class="bg-primary text-white px-4 py-2 rounded-md">Kirim</button>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="closeKomentarModalButton"
                    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-red-500 text-white py-2 px-4 rounded-md hidden">Message sent!
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var dosenId = {{ Auth::user()->dosen_id }};
        var userId = {{ Auth::id() }};
        var hasMessages = false;
        var isBound = false;
        var lastMessageId = null; // Store the last message ID to avoid duplicates

        // Ensure Pusher is loaded
        const pusher = new Pusher('b13119368dad85510365', {
            cluster: 'ap1',
            authEndpoint: '/pusher/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

        const channel = pusher.subscribe('private-chat.' + dosenId);

        function bindEvent() {
            if (!isBound) {
                channel.bind('App\\Events\\MessageSent', function(data) {
                    validateAndAddMessage(data.chat);
                    showToast('New message received!');
                    scrollToBottom();
                });
                isBound = true;
            }
        }

        function fetchMessages() {
            $.ajax({
                url: '/fetch-messages/' + dosenId,
                method: 'GET',
                success: function(messages) {
                    $('#komentarContainer').empty();
                    if (messages.length > 0) {
                        hasMessages = true;
                        messages.forEach(function(message) {
                            addMessage(message);
                        });
                        $('#komentarTextarea').hide();
                        $('#kirimKomentarButton').text('Lihat Diskusi');
                        scrollToBottom();
                    } else {
                        hasMessages = false;
                    }
                    bindEvent(); // Bind event after fetching messages
                }
            });
        }

        function validateAndAddMessage(message) {
            // Check if the message ID is the same as the last message ID
            if (message.id !== lastMessageId) {
                addMessage(message);
                lastMessageId = message.id; // Update the last message ID
                scrollToBottom();
            }
        }

        function addMessage(message) {
            var sender = message.sender === 'user' ? 'Anda' : 'Dosen';
            var messageClass = message.sender === 'user' ? 'bg-info-50 ml-auto' : 'bg-white';
            var alignment = message.sender === 'user' ? 'ml-auto' : '';
            $('#komentarContainer').append('<div class="flex gap-2 items-center my-2' + alignment + '"><div class="' +
                messageClass +
                ' flex flex-col gap-px px-4 py-1 rounded-lg shadow-md w-fit my-2 mx-2"><h4 class="text-sm font-medium">' +
                sender + '</h4><p class="text-xs">' + message.message +
                '</p></div></div>');
        }

        function scrollToBottom() {
            var container = $('#komentarContainer');
            container.scrollTop(container.prop('scrollHeight'));
        }

        $('#kirimKomentarButton').on('click', function() {
            if (hasMessages) {
                showKomentarModal();
            } else {
                var komentar = $('#komentarTextarea').val();
                if (komentar.trim() === '') {
                    showToast('Komentar tidak boleh kosong');
                    return;
                }

                $.ajax({
                    url: '/send-message',
                    method: 'POST',
                    data: {
                        message: komentar,
                        dosen_id: dosenId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#komentarTextarea').val('');
                        fetchMessages();
                    }
                });
            }
        });

        $('#modalKirimKomentarButton').on('click', function() {
            var komentar = $('#modalKomentarTextarea').val();
            if (komentar.trim() === '') {
                showToast('Komentar tidak boleh kosong');
                return;
            }

            $.ajax({
                url: '/send-message',
                method: 'POST',
                data: {
                    message: komentar,
                    dosen_id: dosenId,
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#modalKomentarTextarea').val('');
                    fetchMessages();
                }
            });
        });

        function showKomentarModal() {
            var modal = $('#komentarModal');
            var modalContent = modal.find('.transform');

            modal.removeClass('hidden');
            setTimeout(() => {
                modal.addClass('flex').removeClass('hidden');
                modalContent.removeClass('translate-y-10 opacity-0 scale-95').addClass(
                    'translate-y-0 opacity-100 scale-100');
                scrollToBottom(); // Scroll to the bottom when the modal opens
            }, 10);
        }

        function showToast(message) {
            var toast = $('#toast');
            toast.text(message).removeClass('hidden');
            setTimeout(() => {
                toast.addClass('hidden');
            }, 3000);
        }

        $('#closeKomentarModalButton').on('click', function() {
            var modal = $('#komentarModal');
            var modalContent = modal.find('.transform');

            modalContent.addClass('translate-y-10 opacity-0 scale-95').removeClass(
                'translate-y-0 opacity-100 scale-100');
            setTimeout(() => {
                modal.addClass('hidden').removeClass('flex');
            }, 300);
        });

        fetchMessages();
    </script>
@endsection
