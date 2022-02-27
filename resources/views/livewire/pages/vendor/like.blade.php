<div>
    @if(Auth::guest())
        <a class="link-black text-sm mr-2"> {{ count($this->vendor->likes()) }} <i class="far fa-thumbs-up mr-1"></i></a>
    @else
        <x-link.main wire:click="toggleLike" class="cursor-pointer link-black text-sm mr-2" title="click to like">
           ({{ count($this->vendor->likes()) }}) 
            <i class="far fa-thumbs-up mr-1"></i>
        </x-link.main>
    @endif
</div>

