<div class="fp_footer">
    <x-alerts.loading/>

    <ul class="fp_meta float-right mb0">
        <li class="list-inline-item" title="Click to view property image"><a class="icon" href="{{ asset('storage/'.$property->firstImage()) }}" 
            data-fancybox="gallery-page" 
            data-caption="{{ $property->description() }} {{ trans('global.naira') }}{{ $property->price() }}" 
            class="lightbox-image plus">
            <i class="fa fa-expand" aria-hidden="true"></i> </a>
        </li>
        <li class="list-inline-item" title="Click to book property">
            <a class="icon" href="#" wire:click.prevent="book">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</div>