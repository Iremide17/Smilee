{{-- price --}}
<div class="col-md-12 mt-2">
    <div class="row">
        <div class="col-md-6">
            <label   class="mt-2 p-2" for="my-select">{{ __('Min. Price') }}</label>
            <select id="my-select" class="form-control" wire:model.defer="minPrice">
                @foreach ($prices as $price)
                    <option value="{{ $price}}">{{ $price}}</option>  
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label   class="mt-2 p-2" for="my-select">{{ __('Max. Price') }}</label>
            <select id="my-select" class="form-control" wire:model.defer="maxPrice">
                @foreach ($prices as $price)
                    <option value="{{ $price}}">{{ $price}}</option>  
                @endforeach
            </select>
        </div>
    </div>
</div>