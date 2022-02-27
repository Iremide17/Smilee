
@props(['id', 'disabled' => false])

<input id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'datetimepicker-input border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}
data-toggle="datetimepicker" data-target="#{{ $id }}"
onchange="this.dispatchEvent(new InputEvent('input'))" placeholder="Enter date..."
/>

@push('scripts')
<script>
    $(function () {
        $('#{{ $id }}').datetimepicker({
            format: 'L',
        });
    });
</script>
@endpush


