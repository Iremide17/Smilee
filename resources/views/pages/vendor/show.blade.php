<x-app-layout>

    @section('title', application('name')." | Vendor: $vendor->name")

    @section('keywords')
    @foreach ($vendor->categories() as $category)
        {{ $category->name() }}
    @endforeach
    @endsection

    @section('description')
    {{ $vendor->name() }}
    @endsection

    @section('metaImage')
    {{ asset('storage/' . $vendor->image()) }}
    @endsection

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
          Vendor: {{ $vendor->name() }}
        </h2>
        <p>
            {{ $vendor->description() }}
        </p>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle"
                               src="{{ asset('storage/' .$vendor->image()) }}"
                               alt="{{ $vendor->name() }}">
                        </div>
        
                        <h3 class="profile-username text-center">{{ $vendor->name() }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>{{ Illuminate\Support\Str::plural('Subscribers', $vendor->subscriptions()->count()) }}</b> <a class="float-right">({{ $vendor->subscriptions()->count() }})</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ Illuminate\Support\Str::plural('View', views($vendor)->count()) }}</b> <a class="float-right">({{ views($vendor)->count() }})</a>
                            </li>
                            <li class="list-group-item">
                                @foreach($vendor->categories() as $category)
                                      <a href="#" class="text-sm font-bold uppercase text-theme-blue-100 space-x-2">{{ $category->name() }}</a>
                                @endforeach
                            </li>
                        </ul>
        
                        <div class="m-auto flex justify-between">
                            @can(App\Policies\VendorPolicy::UNSUBSCRIBE, $vendor)
                                    {{-- Unubscribe to vendor button --}}
                                    <x-link.main href="{{ route('smilee.vendors.unsubscribe', $vendor) }}">
                                        {{ __('Unsubscribe') }}
                                    </x-link.main>
                            @elsecan(App\Policies\VendorPolicy::SUBSCRIBE, $vendor)
                                {{-- Subscribe to vendor button --}}
                                <x-link.main href="{{ route('smilee.vendors.subscribe', $vendor) }}">
                                    {{ __('Subscribe') }}
                                </x-link.main>
                            @endcan 

                            <livewire:pages.vendor.like :vendor="$vendor" />
                        </div>
                        
                    </div>
                    </div>
        
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Description</strong>
        
                        <p class="text-muted">
                            {{ $vendor->description() }}
                        </p>
        
                        <hr>
        
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
        
                        <p class="text-muted">{{ $vendor->address() }}</p>
        
                        <hr>
        
                        <strong><i class="fa fa-phone mr-1" aria-hidden="true"></i>Phone</strong>
        
                        <p class="text-muted">
                            {{ $vendor->phone() }}
                        </p>
        
                        <hr>
                
                          {{-- social share --}}
                        <div class="p-1">
                            <x-social.vendor :vendor="$vendor" url="{{ Request::url() }}" />
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card" x-data="{ currentTab: $persist('product') }">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills space-x-4 justify-between" wire:ignore>
                                <li @click.prevent="currentTab = 'product'" class="nav-item">
                                    <a class="nav-link" :class="currentTab === 'product' ? 'active' : ''" href="#product" data-toggle="tab">
                                        <i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i> Products
                                    </a>
                                </li>
                                <li @click.prevent="currentTab = 'furniture'" class="nav-item">
                                    <a class="nav-link" :class="currentTab === 'furniture' ? 'active' : ''" href="#furniture" data-toggle="tab">
                                        <i class="fa fa-table mr-1"></i> 
                                        Furnitures
                                    </a>
                                </li>   
                                <li @click.prevent="currentTab = 'gallery'" class="nav-item">
                                    <a class="nav-link" :class="currentTab === 'gallery' ? 'active' : ''" href="#gallery" data-toggle="tab">
                                        <i class="fa fa-image mr-1"></i> 
                                        Gallary
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" :class="currentTab === 'product' ? 'active' : ''" id="product" wire:ignore.self>
                                    <div class="row">
                                        @forelse($vendor->products as $product)
                                            <x-product.list :product="$product"/>
                                        @empty
                                            <div class="text-center font-bold">
                                                <span>
                                                    <p>No data available</p>
                                                </span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
    
                                <div class="tab-pane" :class="currentTab === 'furniture' ? 'active' : ''" id="furniture" wire:ignore.self>
                                    <div class="row">
                                        @forelse ($vendor->furnitures as $furniture)
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
                                            <div class="text-center font-bold">
                                                <span>
                                                    <p>No data available</p>
                                                </span>
                                            </div>
                                        @endforelse
                                     </div>
                                </div>

                                <div class="tab-pane" :class="currentTab === 'gallery' ? 'active' : ''" id="gallery" wire:ignore.self>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
