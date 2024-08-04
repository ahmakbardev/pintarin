@if (in_array(Route::currentRouteName(), ['latihan']))
    <div class="shadow-md sticky top-0 z-50 container-nav flex justify-between items-center bg-gray2">
        <div class="flex gap-3 items-center">
            <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.99121 18.7422C14.9746 18.7422 19.0879 14.6289 19.0879 9.6543C19.0879 4.67969 14.9658 0.566406 9.98242 0.566406C5.00781 0.566406 0.90332 4.67969 0.90332 9.6543C0.90332 14.6289 5.0166 18.7422 9.99121 18.7422ZM9.99121 16.9316C5.95703 16.9316 2.73145 13.6885 2.73145 9.6543C2.73145 5.62012 5.95703 2.38574 9.98242 2.38574C14.0166 2.38574 17.2598 5.62012 17.2686 9.6543C17.2773 13.6885 14.0254 16.9316 9.99121 16.9316ZM11.7402 13.9873C12.0479 13.6885 12.0391 13.2051 11.7402 12.9238L8.27734 9.66309L11.7402 6.41113C12.0479 6.12988 12.0391 5.6377 11.7314 5.34766C11.4502 5.08398 10.9932 5.09277 10.6943 5.37402L7.11719 8.74023C6.58105 9.23242 6.58105 10.1025 7.11719 10.5947L10.6943 13.9609C10.9668 14.2246 11.4854 14.2422 11.7402 13.9873Z"
                    fill="#1C1C1E" />
            </svg>
            <div class="flex gap-3 items-center">
                {{-- <img src="{{ asset('assets/icons/modul-1.png') }}" class="w-16 object-fill" alt=""> --}}
                <div class="flex flex-col w-full">
                    <p class="text-xs">Latihan Pemahaman</p>
                    <p class="text-lg font-semibold text-primary">Pemimpin yang Memberdayakan</p>
                    {{-- <div class="flex items-center mt-2">
                    <div class="w-2/3 bg-gray-200 rounded-full h-2.5 dark:bg-gray">
                        <div class="bg-primary h-2.5 rounded-full" style="width: 33%"></div>
                    </div>
                    <p class="text-base ml-4">1/3 materi</p>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
@endif
