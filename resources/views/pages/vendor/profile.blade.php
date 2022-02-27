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
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
         Vendor:  {{ $vendor->name() }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <section class="container mx-auto">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-3">
            
                        <!-- Profile Image -->
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
                                          <a href="#" class="text-sm font-bold uppercase text-theme-blue-100">{{ $category->name() }}</a>
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
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
            
                        <!-- About Me Box -->
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
                        <!-- /.card -->
                      </div>
                      
                      <div class="col-md-9">
                        <div class="card">
                          <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="card card-primary">
                                      <div class="card-body">
                                        <div class="row">
                                            @forelse ($vendor->galleries as $image)
                                                <div class="col-sm-2">
                                                    <a href="{{ asset('storage/' . $image->image()) }}" data-toggle="lightbox" data-title="{{ $image->name() }} - {{ $image->description() }}" data-image="image">
                                                        <img src="{{ asset('storage/' . $image->image()) }}" class="img-fluid mb-2" alt="{{ $image->name() }}">
                                                    </a>
                                                </div>
                                            @empty
                                                <span>No images yet from vendor</span>
                                            @endforelse
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <!-- /.card -->
                      </div>
                      
                    </div>
                    <!-- /.row -->
                  </div>
            </section>
        </div>
    </div>

</x-app-layout> 
