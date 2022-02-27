<x-app-layout>
    @section('title', "Product: $product->title")

    @section('keywords')
    @foreach($product->categories() as $category)
        {{ $category->name() }}
    @endforeach
    @endsection

    @section('description')
    {{ $product->excerpt(150) }}
    @endsection

    @section('metaImage')
    {{ asset('storage/' . $product->firstImage()) }}
    @endsection

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ $product->title() }} {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="row">

            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{ $product->title() }}</h3>
              <div class="col-12">
                <img src="{{ asset('storage/'.$product->firstImage()) }}" class="product-image" alt="{{ $product->title() }}">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="{{ asset('storage/'.$product->firstImage()) }}" alt="{{ $product->title() }}"></div>
                @if ($product->secondImage())
                    <div class="product-image-thumb" ><img src="{{ asset('storage/'.$product->secondImage()) }}" alt="{{ $product->title() }}"></div>
                @endif
                @if ($product->thirdImage())
                    <div class="product-image-thumb" ><img src="{{ asset('storage/'.$product->thirdImage()) }}" alt="{{ $product->title() }}"></div>
                @endif
              </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="row">   
                    <div class="col-md-12">
                        <div class="flex flex-row justify-between p-2">
                            <h3 class="my-3 font-bold">{{ $product->title() }}</h3>
                            <span class="my-3 p-2 badge badge-info font-bold">
                                {{ trans('global.naira') }} {{ $product->price() }} 
                            </span>
                        </div>

                        <p>
                            {{ $product->description() }} 
                        </p>

                      <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Vendor</th>
                                <td>{{ $product->vendor->name() }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td> 
                                    @if ($product->type() === 'old')
                                        This product is <span class="badge badge-primary">Old</span>
                                    @elseif ($product->type() === 'new') 
                                    This product is <span class="badge badge-info">New</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Vendor Connect:</th>
                                <td>
                                    <div class="flex space-x-4">
                                        <x-social.profile :author="$product->vendor" />
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="flex flex-col items-center mb-24 space-y-4 blog_post_share">
                            <h2 class="font-serif font-bold capitalize">Share this product to the public</h2>
                        
                        {{-- social share --}}
                            {{-- <x-social.furniture :product="$product" url="{{ Request::url() }}" /> --}}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div>
                            <div class="mt-6 space-y-5">
                                <h2 class="mb-0 text-sm font-bold uppercase">
                                    {{ Illuminate\Support\Str::plural('Comment', count($product->comments())) }}
                                         ({{ count($product->comments()) }})
                                </h2>
                            </div>
      
                          @if ($product->isCommentable())
                              <x-posts.comments :model="$product" :type="$product->commentType()" />
                          @endif   
                        </div>
                    </div>
                </div>        
            </div>

        </div>
    </div>
</x-app-layout>
