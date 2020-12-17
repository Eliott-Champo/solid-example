<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <a href="{{ route('facebook-login') }}" class="inline-block p-6 bg-white border-b border-gray-200 cursor-pointer hover:underline">
                    Connect to Facebook
                </a>
            </div>
        </div>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <a href="{{ route('twitter-login') }}" class="inline-block p-6 bg-white border-b border-gray-200 cursor-pointer hover:underline">
                    Connect to Twitter
                </a>
            </div>
        </div>
    </div>

    @php
    $facebook = auth()->user()->profile->facebook;
    $twitter = auth()->user()->profile->twitter;
    @endphp
    <div class="py-12 space-y-5">
        @if($facebook)
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-blue-600 shadow-sm sm:rounded-lg">
                <a class="inline-block p-6 border-b border-gray-200 cursor-pointer hover:underline">
                    $facebook->name
                </a>
            </div>
        </div>
        @endif

        @if($twitter)
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-blue-300 shadow-sm sm:rounded-lg">
                <a class="inline-block p-6 border-b border-gray-200 cursor-pointer hover:underline">
                    $twitter->name
                </a>
            </div>
        </div>
        @endif
    </div>

</x-app-layout>
