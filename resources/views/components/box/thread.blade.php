<div class="post">

    @isset($user)
        <div class="user-block">
            <x-user.avatar :user="$thread->author()" />
            {{-- <span class="description">Posted: {{ $thread->created_at->diffForHumans() }}</span> --}}
        </div>
    @endisset
    
    @isset($body)
        <div class="space-y-3 p-2">
            {{ $body }}
        </div>
    @endisset

    @isset($button)
        <div class="flex justify-between p-4">
            {{ $button }}
        </div>
    @endisset

    @isset($action)
        <div class="absolute top-0 right-2">
            <div class="flex space-x-2">
                {{ $action }}
            </div>
        </div>
    @endisset
</div>