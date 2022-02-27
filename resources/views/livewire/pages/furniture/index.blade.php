<div class="container">
    <x-alerts.loading/>
    <div class="row">
        <div class="col-md-2">
             <div class="row">
                 <div class="m-auto text-lg font-bold">
                     <h1>Search Variants</h1>
                 </div>
 
                 <div class="col-md-12 mt-2">
                    <x-box.search>
                        <x-slot name="label">
                            Search Furnitures
                        </x-slot>
                    </x-box.search>
                 </div>
 
                 <div class="col-md-12 mt-2">
                     <label for="my-select">Type</label>
                        @foreach ($types as $key => $type)
                            <div class="ml-2">
                                <input wire:model.defer="type" type="radio" value="{{ $key }}"/>
                                {{ $type }}
                            </div>
                        @endforeach
                 </div>

                 <div class="col-md-12 mt-2">
                    <x-box.status>
                        <x-slot name="label">
                            Search Vendors
                        </x-slot>
                        <x-slot name="option">
                            <select wire:model.defer="vendor" class="form-control">
                                <option value="">Select</option>
                                @foreach ($vendors as $id => $vendor)
                                    <option class="m-1" value="{{ $vendor }}">{{ $vendor }}</option>
                                @endforeach
                            </select>
                        </x-slot>
                    </x-box.status>
                 </div>
 
                 <div class="col-md-12 mt-2">
                    <div class="flex flex-row space-x-3 space-y-2">

                        <x-buttons.default wire:click="resetFilter">
                            reset
                        </x-buttons.default>
   
                        <x-buttons.default wire:click="searchFurniture">
                            Search
                        </x-buttons.default>
   
                    </div>
                 </div>

             </div>
        </div>
        <div class="col-md-10">
             <div class="row">
                @forelse ($furnitures as $furniture)
                    <x-agent.card :model="$furniture">
                        <x-slot name="image">
                            <a href="{{ route('smilee.furnitures.show',$furniture) }}">
                                <img class="img-whp" src="{{ asset('storage/'.$furniture->firstImage()) }}" alt="{{ $furniture->title() }}">
                            </a>
                        </x-slot>
                        <x-slot name="sub">
                            <x-slot name="price">
                                <ul class="tag mb0">
                                    <li class="list-inline-item"><a href="#">{{ trans('global.naira') }} {{ $furniture->price() }}</a></li>
                                </ul>
                            </x-slot>
                            <x-slot name="type">
                                <ul class="tag2 mb0">
                                    <li class="list-inline-item"><a href="#">{{ $furniture->type() }}</a></li>
                                </ul>
                            </x-slot>
                            <x-slot name="details">
                                <x-slot name="small">
                                <a href="{{ route('smilee.vendors.show',$furniture->vendor->slug()) }}" x-ref="furnitureLink">
                                    <img src="{{ asset('storage/'.$furniture->vendor->image()) }}" alt="{{ $furniture->vendor->name() }}">
                                </a>
                                </x-slot>
                                <x-slot name="name">
                                    <h4>
                                        <a href="{{ route('smilee.furnitures.show',$furniture) }}">{{ $furniture->title() }}</a>
                                    </h4>
                                </x-slot>
                            </x-slot>
                        </x-slot>
                        
                    </x-agent.card>
                @empty
                    <div class="font-bold text-center">
                        <h1>No data available</h1>
                    </div>
                @endforelse
             </div>
         
             <x-alerts.loadmore :models="$furnitures"/>
        </div>
    </div>
 </div>