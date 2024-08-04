@extends('layouts.layout')

@section('content')
    <div class="container-index w-full">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="pb-28 pt-10 flex gap-20 justify-between">
            <div class="task-deskripsi flex flex-col w-full">
                <div class="flex flex-col gap-2">
                    <h1 class="text-3xl font-medium">{{ $task->title }}</h1>
                    <p class="text-xl font-medium">Deadline
                        {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y h:i A') }}</p>
                    <div class="border-b"></div>
                </div>
                <div class="flex flex-col gap-2 my-5">
                    <h2 class="text-2xl font-medium">Deskripsi</h2>
                    <p class="text-lg">{!! $task->description !!}</p>
                </div>
                <div class="flex flex-col gap-2 my-5">
                    <h2 class="text-2xl font-medium">Kriteria Penilaian</h2>
                    <div class="flex gap-3">
                        @foreach (json_decode($task->kriteria_penilaian) as $kriteria)
                            <div class="bg-blue-50 text-primary w-fit rounded-xl py-2 px-3 ">{{ $kriteria }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="taskContainer"
                class="mx-10 border flex flex-col border-primary rounded-xl py-8 px-8 flex-none min-w-80 h-fit mt-20">
                <h1 class="text-xl font-medium">Kirim Tugas</h1>
                <p class="mt-3">Ditugaskan</p>
                <form id="submitTaskForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="description" id="hiddenDescription">
                    <input type="hidden" name="pdfFilePath" id="hiddenPdfFilePath">
                    <input type="hidden" name="pptFilePath" id="hiddenPptFilePath">
                    <div id="uploadedFiles" class="my-3 flex flex-col gap-3"></div>
                    <div class="my-3 flex flex-col gap-3">
                        <button type="button" id="uploadButton"
                            class="border border-primary text-primary rounded-md py-2">+ Tambah</button>
                        <a href="{{ route('modul', ['id' => $task->modul_id]) }}"
                            class="border bg-primary text-center text-white rounded-md py-2 mt-2">Selesai</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uploadModal"
        class="fixed inset-0 bg-gray-800 bg-opacity-50 backdrop-blur-sm hidden justify-center items-center transition-all ease-in-out duration-300">
        <div
            class="bg-white rounded-lg p-6 w-96 transform transition ease-in-out duration-300 translate-y-10 opacity-0 scale-95">
            <h2 class="text-xl font-semibold mb-4">Unggah Berkas</h2>
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="block w-full mt-1"></textarea>
                </div>
                <div class="mb-4">
                    <label for="pdfFile" class="block text-sm font-medium text-gray-700">Berkas PDF</label>
                    <div class="flex items-center mt-1">
                        <label
                            class="bg-blue-500 text-white py-2 px-4 rounded-l-md cursor-pointer hover:bg-blue-600 transition">Pilih
                            <input type="file" id="pdfFile" name="pdfFile" class="hidden" accept=".pdf">
                        </label>
                        <input type="text" id="pdfFileName"
                            class="block w-full py-2 px-4 outline-none border-none focus:outline-none truncate"
                            placeholder="Berkas kosong" readonly>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="pptFile" class="block text-sm font-medium text-gray-700">Berkas PPT</label>
                    <div class="flex items-center mt-1">
                        <label
                            class="bg-blue-500 text-white py-2 px-4 rounded-l-md cursor-pointer hover:bg-blue-600 transition">Pilih
                            <input type="file" id="pptFile" name="pptFile" class="hidden" accept=".ppt,.pptx">
                        </label>
                        <input type="text" id="pptFileName"
                            class="block w-full py-2 px-4 outline-none border-none focus:outline-none truncate"
                            placeholder="Berkas kosong" readonly>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="cancelButton"
                        class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md">Batal</button>
                    <button type="button" id="saveFilesButton"
                        class="bg-blue-600 text-white py-2 px-4 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-primary text-white py-2 px-4 rounded-md hidden">File type not
        allowed. Please upload only PDF or PPT files.</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let uploadedPdfFile = null;
        let uploadedPptFile = null;

        $('#uploadButton').on('click', function() {
            var modal = $('#uploadModal');
            var modalContent = modal.find('.transform');

            // Fetch data before opening modal
            $.ajax({
                url: '{{ route('tugas-progress.get', $task->id) }}',
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#description').val(response.description);
                        if (response.pdf_path) {
                            $('#pdfFileName').val(response.pdf_path.split('/').pop());
                        }
                        if (response.ppt_path) {
                            $('#pptFileName').val(response.ppt_path.split('/').pop());
                        }
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Terjadi kesalahan saat mengambil data tugas');
                }
            });

            modal.removeClass('hidden');
            setTimeout(() => {
                modal.addClass('flex').removeClass('hidden');
                modalContent.removeClass('translate-y-10 opacity-0 scale-95').addClass(
                    'translate-y-0 opacity-100 scale-100');
            }, 10);
        });

        $('#cancelButton').on('click', function() {
            var modal = $('#uploadModal');
            var modalContent = modal.find('.transform');

            modalContent.addClass('translate-y-10 opacity-0 scale-95').removeClass(
                'translate-y-0 opacity-100 scale-100');
            setTimeout(() => {
                modal.addClass('hidden').removeClass('flex');
            }, 300);
        });

        $('#saveFilesButton').on('click', function() {
            var formData = new FormData($('#uploadForm')[0]);
            var allowedExtensions = ['pdf', 'ppt', 'pptx'];
            var isValid = true;

            var pdfFile = $('#pdfFile')[0].files[0];
            var pptFile = $('#pptFile')[0].files[0];

            if (pdfFile && !allowedExtensions.includes(pdfFile.name.split('.').pop().toLowerCase())) {
                showToast('Ekstensi file PDF tidak valid');
                isValid = false;
            }

            if (pptFile && !allowedExtensions.includes(pptFile.name.split('.').pop().toLowerCase())) {
                showToast('Ekstensi file PPT tidak valid');
                isValid = false;
            }

            if (isValid) {
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('tugas-progress.store', $task->id) }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#hiddenDescription').val(response.description);
                        $('#hiddenPdfFilePath').val(response.pdf_path);
                        $('#hiddenPptFilePath').val(response.ppt_path);

                        fetchTaskProgress({{ $task->id }});

                        $('#uploadForm')[0].reset();
                        $('#uploadModal').find('#pdfFileName').val('');
                        $('#uploadModal').find('#pptFileName').val('');

                        $('#cancelButton').click();
                        showToast('File berhasil disimpan');
                    },
                    error: function(xhr, status, error) {
                        showToast('Terjadi kesalahan saat mengupload file');
                    }
                });
            }
        });

        // Menyesuaikan tombol "Kirim" menjadi tautan
        $('#submitTaskForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('tugas-progress.store', $task->id) }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // window.location.href = '{{ route('modul', ['id' => $task->modul_id]) }}';
                },
                error: function(xhr, status, error) {
                    showToast('Terjadi kesalahan saat mengirim tugas');
                }
            });
        });

        function showToast(message) {
            var toast = $('#toast');
            toast.text(message).removeClass('hidden');
            setTimeout(() => {
                toast.addClass('hidden');
            }, 3000);
        }

        $('#pdfFile').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $('#pdfFileName').val(fileName);
        });

        $('#pptFile').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $('#pptFileName').val(fileName);
        });

        // Function untuk fetch task progress berdasarkan task_id dan user_id
        function fetchTaskProgress(taskId) {
            $.ajax({
                url: '{{ route('tugas-progress.get', $task->id) }}',
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#hiddenDescription').val(response.description);
                        $('#hiddenPdfFilePath').val(response.pdf_path);
                        $('#hiddenPptFilePath').val(response.ppt_path);

                        var uploadFilesContainer = $('#uploadedFiles');
                        uploadFilesContainer.empty();

                        if (response.pdf_path) {
                            var pdfFileElement = `
                    <div class="flex items-center gap-3 border border-gray-200 rounded-md p-2">
                        <img src="{{ asset('assets/icons/PDF.png') }}" alt="PDF" class="w-6 h-6 mr-2">
                        <div class="flex flex-col gap-1">
                            <span class="flex-1 max-w-40 truncate">${response.pdf_path.split('/').pop()}</span>
                            <button class="text-red-500 text-start flex gap-2 items-center hover:text-red-700" onclick="deleteFile('pdf', '${response.pdf_path}', $(this).parent().parent());">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>`;
                            uploadFilesContainer.append(pdfFileElement);
                        }

                        if (response.ppt_path) {
                            var pptFileElement = `
                    <div class="flex items-center gap-3 border border-gray-200 rounded-md p-2">
                        <img src="{{ asset('assets/icons/PPT.png') }}" alt="PPT" class="w-6 h-6 mr-2">
                        <div class="flex flex-col gap-1">
                            <span class="flex-1 max-w-40 truncate">${response.ppt_path.split('/').pop()}</span>
                            <button class="text-red-500 text-start flex gap-2 items-center hover:text-red-700" onclick="deleteFile('ppt', '${response.ppt_path}', $(this).parent().parent());">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>`;
                            uploadFilesContainer.append(pptFileElement);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Terjadi kesalahan saat mengambil data tugas');
                }
            });
        }

        function deleteFile(fileType, filePath, element) {
            $.ajax({
                url: '{{ route('tugas-progress.deleteFile', $task->id) }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    fileType: fileType
                },
                success: function(response) {
                    element.remove();
                    showToast('File berhasil dihapus');
                },
                error: function(xhr, status, error) {
                    showToast('Terjadi kesalahan saat menghapus file');
                }
            });
        }

        $(document).ready(function() {
            fetchTaskProgress({{ $task->id }});
        });
    </script>

@endsection
