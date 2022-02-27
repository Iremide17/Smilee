<div class="row">
    <div class="m-auto">
        <h1>Search Properties</h1>
    </div>

    {{-- search --}}
    <div class="col-md-12 mt-2">
        <label for="my-select">Search</label>
        <input 
        class="appearance-none leading-tight w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
        wire:model.debounce.350ms="searchTerm"
        placeholder="search.."
        type="search"
        >
    </div>

    {{-- type --}}
    <div class="col-md-12 mt-2">
        <label for="my-select">Type</label>
        
        @foreach ($types as $key => $type)
            <div class="ml-2">
                <input wire:model.defer="type" type="radio" value="{{ $key }}"/>
                {{ $type }}
            </div>
        @endforeach
    </div>

    {{-- category --}}
    <div class="col-md-12 mt-2">
        <label class="mt-2 p-2" for="my-select">
            Search Category
        </label>
        @foreach ($categories as $category)
            <div class="ml-2">
                <input wire:model="category" type="radio" value="{{ $category->slug() }}"/>
                {{ $category->name() }}
            </div>
        @endforeach

    </div>

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

    <div class="flex mt-2 p-2">
        <x-buttons.default wire:click="resetFilter">
            reset
        </x-buttons.default>
        <x-buttons.default wire:click="searchProperties">
            Search
        </x-buttons.default>
    </div>
</div>