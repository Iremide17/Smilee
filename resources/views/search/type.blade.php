<div class="col-md-12 mt-2">
    <label for="my-select">Type</label>
    
    @foreach ($types as $key => $type)
        <div class="ml-2">
            <input wire:model.defer="type" type="radio" value="{{ $key }}"/>
            {{ $type }}
        </div>
    @endforeach
</div>