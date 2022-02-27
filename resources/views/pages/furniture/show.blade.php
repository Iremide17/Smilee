<x-app-layout>

    @section('title', application('title')." | Furniture: $furniture->title")

    @section('keywords')
        {{ $furniture->title() }}
    @endsection

    @section('description')
        {{ $furniture->description() }}
    @endsection

    @section('metaImage')
        {{ asset('storage/' . $furniture->firstImage()) }}
    @endsection

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
           {{ $furniture->title() }} {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="card card-solid">
                <div class="card-body">
                  <div class="row">

                    <div class="col-12 col-sm-6">
                      <h3 class="d-inline-block d-sm-none">{{ $furniture->title() }}</h3>
                      <div class="col-12">
                        <img src="{{ asset('storage/'.$furniture->firstImage()) }}" class="product-image" alt="{{ $furniture->title() }}">
                      </div>
                      <div class="col-12 product-image-thumbs">
                        <div class="product-image-thumb active"><img src="{{ asset('storage/'.$furniture->firstImage()) }}" alt="{{ $furniture->title() }}"></div>
                        @if ($furniture->secondImage())
                            <div class="product-image-thumb" ><img src="{{ asset('storage/'.$furniture->secondImage()) }}" alt="{{ $furniture->title() }}"></div>
                        @endif
                        @if ($furniture->thirdImage())
                            <div class="product-image-thumb" ><img src="{{ asset('storage/'.$furniture->thirdImage()) }}" alt="{{ $furniture->title() }}"></div>
                        @endif
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="flex flex-row space-y-2 justify-between">
                            <h3 class="my-3 font-bold text-lg">{{ $furniture->title() }}</h3>
                            <livewire:pages.vendor.furniture :furniture="$furniture" :key="$furniture->id()">
                        </div>
                        <p class="p-2">
                            {{ $furniture->description() }}
                        </p>
        
                      <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            {{ trans('global.naira') }} {{ $furniture->price() }}
                        </h2>
                      </div>

                      <ul class="list_details">
                          <li>

                          </li>
                      </ul>
                      <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Furniture Name:</th>
                                <td>{{ $furniture->title() }}</td>
                            </tr>
                            <tr>
                                <th>Vendor title:</th>
                                <td>{{ $furniture->vendor->name() }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td> 
                                    @if ($furniture->type() == 'old')
                                        This furniture is <span class="badge badge-primary">Old</span>
                                    @elseif ($furniture->type() == 'new') 
                                    This furniture is <span class="badge badge-info">New</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Vendor Connect:</th>
                                <td>
                                    <div class="flex space-x-4">
                                        <x-social.profile :author="$furniture->vendor" />
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                      </div>
                      
                      {{-- book --}}

                       

                        <div class="col-sm-12 mt-2">
                            <div class="flex flex-col items-center mb-24 space-y-4 blog_post_share">
                                <h2 class="font-serif font-bold capitalize">Share this furniture to the public</h2>
                            
                            {{-- social share --}}
                                <x-social.furniture :furniture="$furniture" url="{{ Request::url() }}" />
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

