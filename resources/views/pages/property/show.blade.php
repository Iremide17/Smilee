<x-app-layout>

    @section('title', application('name')." | Property: $property->name()")

    @section('keywords')
        {{ $property->type() }}
    @endsection

    @section('description')
    {{ $property->name() }}
    @endsection

    @section('metaImage')
    {{ asset('storage/' . $property->firstImage()) }}
    @endsection

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
           {{ $property->name() }} {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="card card-solid">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <h3 class="d-inline-block d-sm-none">{{ $property->name() }}</h3>
                      <div class="col-12">
                        <img src="{{ asset('storage/'.$property->firstImage()) }}" class="product-image" alt="{{ $property->name() }}">
                      </div>
                      <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="{{ asset('storage/'.$property->firstImage()) }}" alt="{{ $property->name() }}"></div>
                        @if ($property->secondImage())
                            <div class="product-image-thumb" ><img src="{{ asset('storage/'.$property->secondImage()) }}" alt="{{ $property->name() }}"></div>
                        @endif
                        @if ($property->thirdImage())
                            <div class="product-image-thumb" ><img src="{{ asset('storage/'.$property->thirdImage()) }}" alt="{{ $property->name() }}"></div>
                        @endif
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <h3 class="my-3">{{ $property->name() }}</h3>
                      <p>
                        {{ $property->description() }}
                      </p>
        
                      <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            {{ trans('global.naira') }} {{ $property->price() }}
                        </h2>
                      </div>

                      <ul class="list_details">
                          <li>

                          </li>
                      </ul>
                      <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Property Name:</th>
                                <td>{{ $property->name() }}</td>
                            </tr>
                            <tr>
                                <th>Property Built:</th>
                                <td>{{ $property->yearBuilt() }}</td>
                            </tr>
                            <tr>
                                <th>Property Region:</th>
                                <td>{{ $property->region() }}</td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td>{{ $property->address() }}</td>
                            </tr>
                            <tr>
                                <th>Agent name:</th>
                                <td>{{ $property->agent->name() }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td> 
                                    @if ($property->category() == 'f')
                                        Flat
                                    @elseif ($property->category() == 'ar') 
                                        A room
                                    @elseif ($property->category() == 'sc') 
                                        Self-contain
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td> 
                                    @if ($property->type() == 'rent')
                                        Property is for lease
                                    @elseif ($property->address() == 'sale') 
                                        Property is for sale
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Features:</th>
                                <td>
                                    <x-agent.prop :property="$property" />
                                </td>
                            </tr>
                            <tr>
                                <th>Agent Connect:</th>
                                <td>
                                    <div class="flex space-x-4">
                                        <x-social.profile :author="$property->agent" />
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                      </div>
                      
                      {{-- book --}}

                        <div class="mt-2 flex flex-col items-center mb-18 space-y-4">
                            <h2 class="font-serif font-bold capitalize">Book Property</h2>
                            <livewire:dashboard.agent.book :property="$property"/>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <div class="flex flex-col items-center mb-24 space-y-4 blog_post_share">
                                <h2 class="font-serif font-bold capitalize">Share this property to the public</h2>
                            
                            {{-- social share --}}
                                <x-social.vendor :vendor="$property" url="{{ Request::url() }}" />
                            </div>
                        </div>
        
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.product-image-thumb').on('click', function () {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })
            })
        </script>
    @endpush
</x-app-layout>
