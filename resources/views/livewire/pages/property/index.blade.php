<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <div class="m-auto">
                    <h1>Search Properties</h1>
                </div>
            
                {{-- search --}}
                <div class="col-md-12 mt-2">
                    <label for="my-select">Search</label>
                    <input 
                    class="appearance-none leading-tight w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                    wire:model.debounce.350ms="searchTerm"
                    placeholder="search.."
                    type="search"
                    >
                </div>
            
                {{-- type --}}
                <div class="col-md-12 mt-2">
                    <label for="my-select">Type</label>
                    
                    @foreach ($types as $key => $type)
                        <div class="ml-2">
                            <input wire:model.defer="type" type="radio" value="{{ $key }}"/>
                            {{ $type }}
                        </div>
                    @endforeach
                </div>
            
                {{-- category --}}
                <div class="col-md-12 mt-2">
                    <label class="mt-2 p-2" for="my-select">
                        Search Category
                    </label>
                    @foreach ($categories as $key => $category)
                        <div class="ml-2">
                            <input wire:model.defer="category" type="radio" value="{{ $key }}"/>
                            {{ $category }}
                        </div>
                    @endforeach
            
                </div>
            
                {{-- price --}}
                <div class="col-md-12 mt-2">
                    <label class="mt-2 p-2" for="my-select">
                        Search Price {{ $minPrice }} - {{ $maxPrice }}
                    </label>

                    {{-- <div id="slider" wire:ignore></div> --}}
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label   class="mt-2 p-2" for="my-select">{{ __('Min. Price') }}</label>
                            <select id="my-select" class="form-control" wire:model.defer="minPrice">
                                @foreach ($prices as $price)
                                    <option value="{{ $price}}">{{ $price}}</option>  
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label   class="mt-2 p-2" for="my-select">{{ __('Max. Price') }}</label>
                            <select id="my-select" class="form-control" wire:model.defer="maxPrice">
                                @foreach ($prices as $price)
                                    <option value="{{ $price}}">{{ $price}}</option>  
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            
                <div class="flex mt-2 p-2">
                    <x-buttons.default wire:click="resetFilter">
                        reset
                    </x-buttons.default>
                    <x-buttons.default wire:click="searchProperties">
                        Search
                    </x-buttons.default>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                @foreach ($properties as $property)
                    <x-agent.card :model="$property">
                        <x-slot name="image">
                            <img class="img-whp" src="{{ asset('storage/'.$property->firstImage()) }}" alt="{{ $property->name() }}">
                        </x-slot>
                        <x-slot name="sub">
                            <x-slot name="price">
                                <ul class="tag mb0">
                                    <li class="list-inline-item"><a href="#">{{ trans('global.naira') }} {{ $property->price() }}</a></li>
                                </ul>
                            </x-slot>
                            <x-slot name="type">
                                <ul class="tag2 mb0">
                                    <li class="list-inline-item"><a href="#">{{ $property->type() }}</a></li>
                                </ul>
                            </x-slot>
                        </x-slot>

                        <x-slot name="availaible">
                            <x-slot name="visible">
                                @if ($property->availability())
                                <i class="fa fa-circle text-green-600" aria-hidden="true"></i> Available
                                @else
                                <i class="fa fa-circle text-red-600" aria-hidden="true"></i>  Not Available
                                @endif
                            </x-slot>
                        </x-slot>

                        <x-slot name="details">
                            <x-slot name="small">
                            <a href="{{ route('smilee.agent.property.show',['property' => $property, 'agent' => $property->agent->slug()]) }}">
                                <img src="{{ asset('storage/'.$property->agent->image()) }}" alt="{{ $property->agent->name() }}">
                            </a>
                            </x-slot>
                            <x-slot name="name">
                                <h4>
                                    <a href="{{ route('smilee.agent.property.show',['property' => $property, 'agent' => $property->agent->slug()]) }}">{{ $property->name() }}</a>
                                </h4>
                                <p>{{ $property->address() }}</p>
                            </x-slot>
                            {{-- <x-slot name="prop">
                                <x-agent.prop :property="$property" />
                            </x-slot> --}}
                        </x-slot>

                    </x-agent.card>
                @endforeach
            </div>

            <x-alerts.loadmore :models="$properties"/>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [1,]1000,
            connect: true,
            range: {
                min: [0],
                max: [1000]
            };
            pips:{
                mode:'steps',
                stepped:true,
                density:4
            }
        });

        slider.noUiSlider.on('update', function( value ){
        	@this.set('minPrice', value[0]);
        	@this.set('maxPrice', value[1]);
        });
        
    </script>   
@endpush