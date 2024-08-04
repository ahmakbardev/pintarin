@extends('layouts.layout')

@section('content')
    <div class="materi-content flex flex-col justify-between w-full relative">
        <button id="mark-question" class="absolute top-5 right-5 flex items-center gap-3 border p-3 rounded-md">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3.13595 3.6625C3.0339 3.75096 2.95216 3.86042 2.89634 3.98339C2.84052 4.10637 2.81192 4.23995 2.81251 4.375V17.5C2.81251 17.7486 2.91128 17.9871 3.0871 18.1629C3.26291 18.3387 3.50137 18.4375 3.75001 18.4375C3.99865 18.4375 4.23711 18.3387 4.41292 18.1629C4.58874 17.9871 4.68751 17.7486 4.68751 17.5V14.1969C6.47188 12.8594 7.97657 13.4844 10.2094 14.5875C11.4774 15.2125 12.9234 15.9312 14.4906 15.9312C15.6406 15.9312 16.8563 15.5453 18.1141 14.4562C18.2153 14.3685 18.2966 14.26 18.3524 14.1382C18.4082 14.0164 18.4372 13.884 18.4375 13.75V4.375C18.4375 4.19525 18.3859 4.01927 18.2887 3.86804C18.1916 3.71681 18.053 3.59671 17.8895 3.52203C17.726 3.44736 17.5444 3.42126 17.3665 3.44686C17.1886 3.47246 17.0218 3.54867 16.8859 3.66641C14.9555 5.33906 13.407 4.70625 11.0406 3.53516C8.84298 2.44297 6.10704 1.08906 3.13595 3.6625ZM16.5625 13.3016C14.7781 14.6398 13.2734 14.0133 11.0406 12.9109C9.23126 12.0125 7.05704 10.9375 4.68751 12.0211V4.81953C6.47188 3.48203 7.97657 4.10703 10.2094 5.21016C11.4774 5.83516 12.9234 6.55391 14.4906 6.55391C15.206 6.55498 15.9131 6.40008 16.5625 6.1V13.3016Z"
                    fill="#1C1C1C" />
            </svg>
            Tandai Soal
        </button>
        <div class="text mt-12">
            <h1 class="text-3xl font-semibold" id="question-text">{{ $questions[0]->question }}</h1>
            <div class="flex flex-col gap-4 items-center my-8" id="answers-container">
                @foreach (json_decode($questions[0]->answers) as $index => $answer)
                    <div class="answer-option flex w-full lg:w-2/3 items-center gap-5 ring-1 group hover:ring-primary hover:ring-2 ring-slate-400 transition-all ease-in-out p-3 rounded-lg cursor-pointer"
                        data-answer="{{ $answer }}">
                        <div
                            class="text-2xl font-semibold ring-1 ring-slate-400 group-hover:ring-primary group-hover:ring-2 duration-300 transition-all ease-in-out w-14 grid place-content-center p-3 rounded-lg aspect-square">
                            {{ chr(65 + $index) }}
                        </div>
                        <p>{{ $answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-between items-center my-5">
            <button id="prev-question"
                class="flex gap-3 items-center hover:ring-2 hover:ring-primary transition-all ease-in-out py-3 px-6 rounded-full group"
                disabled>
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                        class="group-hover:fill-primary transition-all ease-in-out" fill="black" />
                </svg>
                <p class="group-hover:text-primary transition-all ease-in-out">Sebelumnya</p>
            </button>
            <button id="next-question"
                class="flex gap-3 items-center hover:ring-2 hover:ring-primary transition-all ease-in-out py-3 px-6 rounded-full group">
                <p class="group-hover:text-primary transition-all ease-in-out">Selanjutnya</p>
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="rotate-180">
                    <path
                        d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                        class="group-hover:fill-primary transition-all ease-in-out" fill="black" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div id="submitModal"
        class="fixed inset-0 bg-grayScale-600 backdrop-blur-sm bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-1/3">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Pengiriman</h2>
            <p class="mb-4">Apakah Anda yakin ingin mengirim jawaban Anda?</p>
            <button id="confirm-submit" class="bg-primary text-white px-4 py-2 rounded-md mr-2">Submit</button>
            <button id="cancel-submit" class="bg-grayScale-500 text-white px-4 py-2 rounded-md">Batal</button>
        </div>
    </div>

    <!-- Result Modal -->
    <div id="resultModal"
        class="fixed inset-0 bg-grayScale-600 backdrop-blur-sm bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-1/3 transition-transform transform translate-y-8">
            <h2 class="text-xl font-semibold mb-4" id="result-title"></h2>
            <p class="mb-4" id="result-message"></p>
            <button id="retry" class="bg-primary text-white px-4 py-2 rounded-md mr-2 hidden">Ulangi</button>
            <button id="close-result" class="bg-primary text-white px-4 py-2 rounded-md hidden">Selesai</button>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-5 right-5 bg-black text-white p-4 rounded-lg shadow-lg hidden">
        <p id="toast-message"></p>
    </div>

    <script>
        $(document).ready(function() {
            let currentQuestionIndex = 0;
            const questions = @json($questions);
            let answers = Array(questions.length).fill(null);
            let markedQuestions = Array(questions.length).fill(false);

            function loadQuestion(index) {
                $('#question-text').text(`${index + 1}. ${questions[index].question}`);
                $('#answers-container').empty();
                const answersList = JSON.parse(questions[index].answers);

                answersList.forEach((answer, i) => {
                    const answerHtml = `
                        <div class="answer-option flex w-full lg:w-2/3 items-center gap-5 ring-1 group hover:ring-primary hover:ring-2 ring-slate-400 transition-all ease-in-out p-3 rounded-lg cursor-pointer" data-answer="${answer}">
                            <div class="text-2xl font-semibold ring-1 ring-slate-400 group-hover:ring-primary group-hover:ring-2 duration-300 transition-all ease-in-out w-14 grid place-content-center p-3 rounded-lg aspect-square">
                                ${String.fromCharCode(65 + i)}
                            </div>
                            <p>${answer}</p>
                        </div>`;
                    $('#answers-container').append(answerHtml);
                });

                $('.answer-option').removeClass('bg-primary text-white');
                if (answers[index] !== null) {
                    $(`.answer-option[data-answer="${answers[index]}"]`).addClass('bg-primary text-white');
                }

                $('#mark-question').toggleClass('bg-yellow-500', markedQuestions[index]);
            }

            function updateNavigationButtons() {
                $('#prev-question').prop('disabled', currentQuestionIndex === 0);
                if (currentQuestionIndex === questions.length - 1) {
                    $('#next-question').text('Submit');
                } else {
                    $('#next-question').text('Selanjutnya');
                }
            }

            function updateSidebar() {
                $('.sidebar-question').each(function(index) {
                    const answered = answers[index] !== null;
                    const marked = markedQuestions[index];
                    $(this).toggleClass('bg-primary text-white', index === currentQuestionIndex && !marked);
                    $(this).toggleClass('bg-yellow-500', marked);
                    $(this).toggleClass('bg-blue-500 text-white', answered && !marked);
                    $(this).toggleClass('bg-white', !answered && !marked);

                    $(this).find('svg').remove();
                    if (marked) {
                        $(this).append(`
                            <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 20L0 0H22V20Z" fill="#FFF500" />
                            </svg>
                        `);
                    }
                });
            }

            $('#prev-question').click(function() {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    loadQuestion(currentQuestionIndex);
                    updateNavigationButtons();
                    updateSidebar();
                }
            });

            $('#next-question').click(function() {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    loadQuestion(currentQuestionIndex);
                    updateNavigationButtons();
                    updateSidebar();
                } else {
                    if (markedQuestions.includes(true)) {
                        showToast("Masih ada soal yang ditandai! Harap selesaikan sebelum mengirim.");
                    } else if (answers.includes(null)) {
                        showToast("Masih ada soal yang belum dijawab! Harap selesaikan sebelum mengirim.");
                    } else {
                        $('#submitModal').removeClass('hidden').addClass('flex').hide().fadeIn();
                    }
                }
            });

            $(document).on('click', '.answer-option', function() {
                $('.answer-option').removeClass('bg-primary text-white');
                $(this).addClass('bg-primary text-white');
                answers[currentQuestionIndex] = $(this).data('answer');
                updateSidebar();
            });

            $('#mark-question').click(function() {
                markedQuestions[currentQuestionIndex] = !markedQuestions[currentQuestionIndex];
                $(this).toggleClass('bg-yellow-500', markedQuestions[currentQuestionIndex]);
                updateSidebar();
            });

            $('.sidebar-question').on('click', function() {
                const index = $(this).data('index');
                currentQuestionIndex = index;
                loadQuestion(currentQuestionIndex);
                updateNavigationButtons();
                updateSidebar();
            });

            $('#confirm-submit').click(function() {
                $.ajax({
                    url: "{{ route('post-test.store', $questions[0]->modul_id) }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        answers: answers
                    },
                    success: function(response) {
                        $('#submitModal').fadeOut(function() {
                            $(this).removeClass('flex').addClass('hidden');
                        });
                        if (response.status === 'fail') {
                            $('#result-title').text('Gagal');
                            $('#result-message').text(response.message);
                            $('#retry').removeClass('hidden').attr('onclick',
                                'location.href="' + response.redirect + '"');
                            $('#close-result').addClass('hidden');
                        } else {
                            $('#result-title').text('Berhasil');
                            $('#result-message').text(response.message);
                            $('#retry').addClass('hidden');
                            $('#close-result').removeClass('hidden').attr('onclick',
                                'location.href="' + response.redirect + '"');
                        }
                        $('#resultModal').removeClass('hidden').addClass('flex').hide()
                    .fadeIn();
                    }
                });
            });

            $('#cancel-submit').click(function() {
                $('#submitModal').fadeOut(function() {
                    $(this).removeClass('flex').addClass('hidden');
                });
            });

            $('#close-result').click(function() {
                $('#resultModal').fadeOut(function() {
                    $(this).removeClass('flex').addClass('hidden');
                });
            });

            function showToast(message) {
                const toast = $('#toast');
                $('#toast-message').text(message);
                toast.removeClass('hidden').addClass('transform translate-y-2 opacity-0');
                toast.animate({
                    opacity: 1,
                    transform: 'translateY(0)',
                    scale: 1
                }, 300, function() {
                    setTimeout(function() {
                        toast.animate({
                            opacity: 0,
                            transform: 'translateY(-10px)',
                            scale: 0.95
                        }, 300, function() {
                            toast.addClass('hidden');
                        });
                    }, 2000);
                });
            }

            loadQuestion(currentQuestionIndex);
            updateNavigationButtons();
            updateSidebar();
        });
    </script>
@endsection
