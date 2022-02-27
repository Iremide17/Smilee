<div class="col-md-12 mt-2">
    <label class="mt-2 p-2" for="my-select">
        Search Category
    </label>
    @foreach ($categories as $key => $category)
        <div class="ml-2">
        <input wire:model="category" type="radio" value="{{ $key }}"/>
        {{ $category }}
        </div>
    @endforeach

</div>