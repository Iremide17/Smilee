<div class="col-md-12 mt-2">
    <label for="my-select">Search</label>
    <input 
    class="appearance-none leading-tight w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
    wire:model.debounce.350ms="searchTerm"
    placeholder="search.."
    type="search"
    >
</div>