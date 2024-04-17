@props([
    'target' => null
])
<div>
    <div class="fixed z-[1000] inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full px-5" wire:loading wire:target="{{$target}}">
        <div class="relative top-[220px] sm:mx-auto p-5 border sm:w-96 shadow-lg rounded-md bg-white w-full">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full">
                    <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-rose-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Loading...</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Tolong tunggu beberapa saat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>