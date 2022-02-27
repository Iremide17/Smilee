<ul class="prop_details mb0">
    @if ($property->fence())
        <li class="list-inline-item"><br><i class="fa fa-check text-green-600" aria-hidden="true"></i> Fenced</li>
    @else
        <li class="list-inline-item"><br><i class="fa fa-times text-red-600" aria-hidden="true"></i> Fenced</li>
    @endif

    @if ($property->tiled())
        <li class="list-inline-item"><br><i class="fa fa-check text-green-600" aria-hidden="true"></i> Tiled</li>
    @else
        <li class="list-inline-item"><br><i class="fa fa-times text-red-600" aria-hidden="true"></i> Tiled</li>
    @endif

    @if ($property->well())
        <li class="list-inline-item"><br><i class="fa fa-check text-green-600" aria-hidden="true"></i> Well</li>
    @else
        <li class="list-inline-item"><br><i class="fa fa-times text-red-600" aria-hidden="true"></i> Well</li>
    @endif

    @if ($property->tap())
        <li class="list-inline-item"><br><i class="fa fa-check text-green-600" aria-hidden="true"></i> Tap</li>
    @else
        <li class="list-inline-item"><br><i class="fa fa-times text-red-600" aria-hidden="true"></i> Tap</li>
    @endif

    @if ($property->toilet())
        <li class="list-inline-item"><br><i class="fa fa-check text-green-600" aria-hidden="true"></i> Toilet</li>
    @else
        <li class="list-inline-item"><br><i class="fa fa-times text-red-600" aria-hidden="true"></i> Toilet</li>
    @endif
</ul>