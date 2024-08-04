@if (in_array(Route::currentRouteName(), ['post-test']))
    <div id="sidebar" class="shadow-md sticky top-24 z-40 px-12 bg-blackMain latihan-sidebar-expanded">
        <div class="sticky top-24">
            <div class="relative">
                <button id="btn-sidebar"
                    class="absolute top-20 -right-[4.2rem] bg-primary flex justify-center items-center w-10 aspect-square rounded-full text-white">
                    <svg id="btn-icon" class="transition-transform duration-300" width="8" height="14"
                        viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.156006 6.70368C0.156006 6.96735 0.253941 7.19336 0.464879 7.38923L6.32593 13.1297C6.49166 13.2955 6.7026 13.3859 6.95121 13.3859C7.44842 13.3859 7.84769 12.9941 7.84769 12.4894C7.84769 12.2408 7.74222 12.0223 7.57649 11.8491L2.29551 6.70368L7.57649 1.55831C7.74222 1.38504 7.84769 1.15904 7.84769 0.917969C7.84769 0.413225 7.44842 0.0214844 6.95121 0.0214844C6.7026 0.0214844 6.49166 0.111886 6.32593 0.277623L0.464879 6.0106C0.253941 6.21401 0.156006 6.44001 0.156006 6.70368Z"
                            fill="white"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="sticky top-24 py-10 h-[55.1rem] flex flex-col justify-between">
            <div class="grid grid-cols-5 lg:grid-cols-4 2xl:grid-cols-5 gap-3">
                @foreach ($questions as $index => $question)
                    <div class="sidebar-question {{ $index == 0 ? 'bg-primary text-white' : 'bg-white' }} py-2 px-4 rounded-lg flex flex-col gap-1 items-center relative cursor-pointer"
                        data-index="{{ $index }}">
                        <p>{{ $index + 1 }}</p>
                        <svg class="absolute top-0 right-0 hidden marked-icon" width="22" height="20"
                            viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 20L0 0H22V20Z" fill="#FFF500" />
                        </svg>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col gap-[6.5rem] relative">
                <!-- Legend -->
                <div class="flex flex-col gap-3 relative">
                    <div class="grid grid-cols-5 gap-3 items-center">
                        <div class="bg-primary py-2 rounded-lg flex flex-col gap-1 items-center">
                            <p class="text-transparent">6</p>
                        </div>
                        <div class="col-span-4 text-white">Sudah dijawab</div>
                    </div>
                    <div class="grid grid-cols-5 gap-3 items-center">
                        <div class="bg-yellow-500 py-2 rounded-lg flex flex-col gap-1 items-center relative">
                            <svg class="absolute top-0 right-0" width="22" height="20" viewBox="0 0 22 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 20L0 0H22V20Z" fill="#FFF500" />
                            </svg>
                            <p class="text-transparent">6</p>
                        </div>
                        <div class="col-span-4 text-white">Kosong/ Ditandai</div>
                    </div>
                    <div class="grid grid-cols-5 gap-3 items-center">
                        <div class="bg-white py-2 rounded-lg flex flex-col gap-1 items-center">
                            <p class="text-transparent">6</p>
                        </div>
                        <div class="col-span-4 text-white">Belum dijawab</div>
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

        // Handle smooth page transition and setting active state
        $('.sidebar-question').on('click', function() {
            const index = $(this).data('index');
            currentQuestionIndex = index;
            loadQuestion(currentQuestionIndex);
            updateSidebar();
        });

        function updateSidebar() {
            $('.sidebar-question').each(function(index) {
                const answered = answers[index] !== null;
                const marked = markedQuestions[index];
                $(this).toggleClass('bg-primary text-white', index === currentQuestionIndex && !marked);
                $(this).toggleClass('bg-yellow-500', marked);
                $(this).toggleClass('bg-blue-500 text-white', answered && !marked);
                $(this).toggleClass('bg-white', !answered && !marked);

                $(this).find('svg.marked-icon').toggleClass('hidden', !marked);
            });
        }

        let currentQuestionIndex = 0;
        const questions = @json($questions);
        let answers = Array(questions.length).fill(null);
        let markedQuestions = Array(questions.length).fill(false);

        // Expose functions to global scope
        window.loadQuestion = function(index) {
            currentQuestionIndex = index; // Update currentQuestionIndex here to fix flickering
            const question = questions[index];
            const answersList = JSON.parse(question.answers);

            $('#question-text').text(question.question);
            $('#answers-container').empty();

            answersList.forEach((answer, i) => {
                const answerHtml = `
                    <div class="flex w-full lg:w-2/3 items-center gap-5 ring-1 group hover:ring-primary hover:ring-2 ring-slate-400 transition-all ease-in-out p-3 rounded-lg answer-option" data-answer="${answer}">
                        <div class="text-2xl font-semibold ring-1 ring-slate-400 group-hover:ring-primary group-hover:ring-2 duration-300 transition-all ease-in-out w-14 grid place-content-center p-3 rounded-lg aspect-square">
                            ${String.fromCharCode(65 + i)}
                        </div>
                        <p>${answer}</p>
                    </div>
                `;
                $('#answers-container').append(answerHtml);
            });

            // Mark selected answer
            if (answers[currentQuestionIndex] !== null) {
                $(`.answer-option[data-answer="${answers[currentQuestionIndex]}"]`).addClass('bg-primary text-white');
            }

            // Update marked state
            $('#mark-question').toggleClass('bg-yellow-500', markedQuestions[currentQuestionIndex]);
        }

        window.updateSidebar = function() {
            $('.sidebar-question').each(function(index) {
                const answered = answers[index] !== null;
                const marked = markedQuestions[index];
                $(this).toggleClass('bg-primary text-white', index === currentQuestionIndex && !marked);
                $(this).toggleClass('bg-yellow-500', marked);
                $(this).toggleClass('bg-blue-500 text-white', answered && !marked);
                $(this).toggleClass('bg-white', !answered && !marked);

                $(this).find('svg.marked-icon').toggleClass('hidden', !marked);
            });
        }
    </script>
@endif
