@if (!empty($author->facebook()))
<a href="https://facebook.com/{{ $author->facebook() }}" target="_blank">
    <x-fab-facebook-f class="h-4 text-red-500" />
</a>
@endif

@if (!empty($author->twitter()))
<a href="https://twitter.com/{{ $author->twitter() }}" target="_blank">
    <x-fab-twitter class="h-4 text-red-500" />
</a>
@endif

@if (!empty($author->instagram()))
<a href="https://instagram.com/{{ $author->instagram() }}" target="_blank">
    <x-fab-instagram-square class="h-4 text-red-500" />
</a>
@endif

@if (!empty($author->linkedin()))
<a href="https://linkedin.com/{{ $author->linkedin() }}" target="_blank">
    <x-fab-linkedin-in class="h-4 text-red-500" />
</a>
@endif