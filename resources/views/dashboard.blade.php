<x-app-layout>
    @section('title', application('name'))

    @section('keywords')
        {{ application('motto') }}
    @endsection

    @section('description')
        {{ application('description') }}
    @endsection

    @section('metaImage')
        {{ asset('storage/' . application('image')) }}
    @endsection
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-50 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p>
            Welcome to {{ application('name') }} ({{ application('alias') }}) - {{ application('motto')}}!
        </p>
        {{-- social share --}}
        <div class="flex flex-wrap gap-1">

            {{-- Facebook --}}
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" 
                target="_blank" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-400 focus:outline-none focus:border-gray-100 focus:ring focus:ring-gray-100 disabled:opacity-25 transition">
                <x-fab-facebook-f class="w-5 h-5" />
            </a>
        
            {{-- Twitter --}}
            <a href="https://twitter.com/intent/tweet?url={{ Request::url() }}text={{ application('name') }}" 
                target="_blank" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-400 focus:outline-none focus:border-gray-100 focus:ring focus:ring-gray-100 disabled:opacity-25 transition">
                <x-fab-twitter class="w-5 h-5" />
            </a>
        
            {{-- Whatsapp --}}
            <a href="https://wa.me/?text={{ application('name') }} {{ Request::url() }}" 
                target="_blank" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-400 focus:outline-none focus:border-gray-100 focus:ring focus:ring-gray-100 disabled:opacity-25 transition">
                <x-fab-whatsapp class="w-5 h-5" />
            </a>
        
            {{-- Telegram --}}
            <a href="https://telegram.me/share/url?url={{ Request::url() }}&text={{ application('name') }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-400 focus:outline-none focus:border-gray-100 focus:ring focus:ring-gray-100 disabled:opacity-25 transition">
                <x-fab-telegram-plane class="w-5 h-5" />
            </a>
        
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
