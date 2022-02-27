<div class="flex justify-center my-16 p-2">
    @if ($models->hasMorePages())
        <x-jet-button wire:click="loadMore">
            Load More
            <div wire:loading>
                <div class="Ids-ellipsis"><div></div><div></div><div></div>
            </div>
        </x-jet-button>
    @endif
</div>