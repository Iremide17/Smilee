
<div {{ $attributes->merge(['type' => 'submit', 'class' => 'small-box']) }} >
    <div {{ $attributes->merge(['class' => 'inner']) }}>
            <h3 {{  $count->attributes->class([''])  }}>
                @isset($count)
                    {{ $count }}
                @endisset
            </h3>

                <p {{ $body->attributes->class(['']) }}>
                    @isset($body)
                        {{ $body }}
                    @endisset
                </p>
    </div>
    <div {{ $attributes->merge(['class' => 'icon']) }} >
        @isset($icon)
            {{ $icon }}
        @endisset
    </div>
    
        @isset($link)
            {{ $link }}
        @endisset
</div>