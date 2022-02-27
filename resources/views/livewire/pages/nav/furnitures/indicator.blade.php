<div>
    <li class="nav-item dropdown">
        @if(count($hasFurnishs['furnitures']) > 0)
            <span class="nav-link cursor-pointer" data-toggle="dropdown" title="Click to see the furnitures you wish to furnish">
                <i class="fa fa-table" aria-hidden="true"></i>
                <livewire:pages.nav.furnitures.count />
            </span>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @foreach ($hasFurnishs['furnitures'] as $hasFurnish)
                        <div class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('storage/'.$hasFurnish->firstImage()) }}" alt="{{ $hasFurnish->title() }}" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ $hasFurnish->title() }}
                                        <span wire:click="removeFromFurnish({{ $hasFurnish->id() }})" class="float-right text-sm text-danger cursor-pointer"><i class="fa fa-times"></i></span>
                                    </h3>
                            </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="{{  route('smilee.furnish') }}" class="dropdown-item dropdown-footer">
                        See all
                        {{ Illuminate\Support\Str::plural('Furniture', $hasFurnishs) }} in your furnish.
                    </a>
            </div>
        @endif
    </li>
</div>
