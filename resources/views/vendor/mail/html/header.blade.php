<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('storage/'.application('image')) }}" class="logo" alt="{{ applicaion('image') }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
