<div class="flex flex-wrap gap-5">
    {{-- facebook --}}
    <x-buttons.social href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
        <x-fab-facebook-f class="w-5 h-5" />
    </x-buttons.social>

    {{-- twitter --}}
    <x-buttons.social href="https://twitter.com/intent/tweet?url={{ $url }}text={{ $vendor->name() }}" target="_blank">
        <x-fab-twitter class="w-5 h-5" />
    </x-buttons.social>

    {{-- instagram --}}
    <x-buttons.social href="https://wa.me/?text={{ $vendor->name() }} {{ $url }}" target="_blank">
        <x-fab-whatsapp class="w-5 h-5" />
    </x-buttons.social>

    {{-- linkedin --}}
    <x-buttons.social href="https://telegram.me/share/url?url={{ $url }}$text={{ $vendor->name() }}" target="_blank">
        <x-fab-telegram-plane class="w-5 h-5" />
    </x-buttons.social>
</div>