    @isset($label)
        <label for="my-select">
            {{ $label }}
        </label>
    @endisset
    <input type="search"
        class="form-control w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
        wire:model.debounce.350ms="searchTerm" 
        placeholder="Enter search..."
        list="data"
    >
    @isset($datalist)
        <datalist id="data">
            {{ $datalist }}
        </datalist>
    @endisset
 