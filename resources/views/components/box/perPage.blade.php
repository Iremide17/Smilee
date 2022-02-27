@isset($label)
<label for="my-select">
    {{ $label }}
</label>
@endisset
<select id="my-select" class="form-control" wire:model="per_page">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
</select>