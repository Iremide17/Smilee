<div class="container">
   <div class="row">
       <div class="col-md-2">
            <div class="row">
                <div class="m-auto">
                    <h1>Search Properties</h1>
                </div>

                <div class="col-md-12 mt-2">
                    {{-- <label for="my-select">Search
                        @if($searchTerm != null) <a wire:click="clearSearchTermFilter">
                        <i class="fa fa-times text-red-500 text-sm ml-2 cursor-pointer" aria-hidden="true">clear</i></a> @endif
                    </label> --}}
                    <input 
                    class="appearance-none leading-tight w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                    wire:model.debounce.350ms="searchTerm"
                    placeholder="search.."
                    type="search"
                    >
                </div>

                <div class="col-md-12 mt-2">
                    <label for="my-select">Type</label>
                    
                    @foreach ($types as $key => $type)
                        <div class="ml-2">
                            <input wire:model.defer="type" type="radio" value="{{ $key }}"/>
                            {{ $type }}
                        </div>
                    @endforeach
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
       </div>
       <div class="col-md-10">
            <div class="row">
                @foreach ($posts as $post)
                <x-posts.latest :post="$post" />
                @endforeach
            </div>
        
            <x-alerts.loadmore :models="$posts"/>
       </div>
   </div>
</div>