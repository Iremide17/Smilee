<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-12">
                <label for="my-select">
                    @if($searchTerm != null) <a wire:click="clearSearchTermFilter">
                    <i class="fa fa-times text-red-500 font-bold text-sm ml-2 cursor-pointer btn btn-default" aria-hidden="true"> clear search </i></a> @endif
                </label>
                <input type="text" class="form-control w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" wire:model.debounce.350ms="searchTerm" placeholder="Search for...">
            </div>
        </div>

        <div class="mixitup-gallery">
            
            <div class="filter-list row clearfix" id="MixItUpEE9F80">
                
                <!-- Gallery Block Five -->
                @forelse ($agents as $agent)
                    <x-agent.gallery :agent="$agent"/>
                @endforeach

            </div>
            
            <x-alerts.loadmore :models="$agents"/>
            
        </div>
        
    </div>
</div>
