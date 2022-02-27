<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl" role="document">
        @if ($showAgent == 'agent')
            @include('partials.agentModal')
        @elseif($showVendor == 'vendor')
            @include('partials.vendorModal')
        @elseif($showWriter == 'writer')
            @include('partials.writerModal')
        @endif
    </div>
    <!-- /.modal-dialog -->
</div>