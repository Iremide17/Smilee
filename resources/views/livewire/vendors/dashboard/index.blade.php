<div>

    <x-alerts.loading/>

    <div class="row">
        <div class="col-sm-12 flex flex-row justify-center">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info">
                      <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </span>

                  <div class="info-box-content">
                    <span class="info-box-text">Wallet Balance</span>
                    <span class="info-box-number">
                        {{ trans('global.naira') }}
                        {{ $vendor->user()->balance }}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="col-sm-12">

            <div class="card" x-data="{ currentTab: $persist('product') }">
                <div class="card-header p-2">
                    <ul class="nav nav-pills space-x-4 justify-between" wire:ignore>
                        <li @click.prevent="currentTab = 'product'" class="nav-item">
                            <a class="nav-link" :class="currentTab === 'product' ? 'active' : ''" href="#product" data-toggle="tab">
                                <i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i> Products ({{ $vendor->vendorProducts() }})
                            </a>
                        </li>

                        <li @click.prevent="currentTab = 'gallery'" class="nav-item">
                            <a class="nav-link" :class="currentTab === 'gallery' ? 'active' : ''" href="#gallery" data-toggle="tab">
                                <i class="fa fa-image mr-1"></i>
                                Gallary ({{ $vendor->vendorGalleries() }})
                            </a>
                        </li>

                        <li @click.prevent="currentTab = 'order'" class="nav-item">
                            <a class="nav-link" :class="currentTab === 'order' ? 'active' : ''" href="#order" data-toggle="tab">
                                <i class="fas fa-file mr-1"></i>
                                Order
                            </a>
                        </li>

                        <li @click.prevent="currentTab = 'edit'" class="nav-item">
                            <a class="nav-link" :class="currentTab === 'edit' ? 'active' : ''" href="#edit" data-toggle="tab">
                                <i class="fas fa-edit mr-1"></i>
                                Edit Details
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" :class="currentTab === 'product' ? 'active' : ''" id="product" wire:ignore.self>
                            <div class="p-5">

                                <div class="float-right p-2">
                                    <x-link.main href="{{ route('vendor.product.create') }}">
                                        Create Product
                                    </x-link.main>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody class="divide-y divide-gray-200 divide-solid">
                                            @forelse ($vendor->products as $key => $product)
                                                <tr>
                                                    <x-table.data>
                                                        <div>{{ $key+1 }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <img width="50" class="cursor-pointer img-circle" src="{{ asset('storage/' .$product->firstImage())}}" alt="">
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>{{ $product->title() }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            {{ trans('global.naira') }}
                                                            {{ number_format($product->price(), 2) }}
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>{{ $product->type() }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            @foreach ($product->categories() as $category)
                                                                <p class="badge badge-info pl-1">
                                                                    {{ $category->name()}}
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div class="text-center">
                                                            <span class="badge {{ $product->status_badge }}">
                                                                {{ $product->status->name }}
                                                            </span>
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div class="flex justify-center space-x-4">

                                                            <x-link.secondary href="{{ route('vendor.product.edit', $product) }}">
                                                                <x-zondicon-edit-pencil class="w-5 h-5" />
                                                            </x-link.secondary>

                                                            <livewire:vendor.product.delete :product="$product" :key="$product->id()" />

                                                        </div>
                                                    </x-table.data>
                                                </tr>
                                            @empty
                                                <div class="text-center">
                                                    <span>
                                                        No data available
                                                    </span>
                                                </div>
                                            @endforelse

                                            {{-- {{ $vendor->products->links('pagination::default') }} --}}
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" :class="currentTab === 'gallery' ? 'active' : ''" id="gallery" wire:ignore.self>
                            <div class="p-5">
                                <div class="float-right p-2">
                                    <x-link.main href="{{ route('vendor.gallery.create') }}">
                                        Create Gallery
                                    </x-link.main>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody class="divide-y divide-gray-200 divide-solid">
                                            @forelse ($vendor->galleries as $key => $gallery)
                                                <tr>
                                                    <x-table.data>
                                                        <div>{{ $key+1 }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>{{ $gallery->name() }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>{{ $gallery->excerpt(100) }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            <img src="{{ asset('storage/'.$gallery->image()) }}" width="50" class="img img-circle" alt="{{ $gallery->name() }}">
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div class="flex justify-center space-x-4">

                                                            <x-link.main href="{{ route('vendor.gallery.edit', $gallery) }}">
                                                                <x-zondicon-edit-pencil class="w-5 h-5" />
                                                            </x-link.main>

                                                            <livewire:vendor.gallery.delete :gallery="$gallery" :key="$gallery->id()" />

                                                        </div>
                                                    </x-table.data>
                                                </tr>
                                            @empty
                                                <div class="text-center">
                                                    <span>
                                                        No data available
                                                    </span>
                                                </div>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" :class="currentTab === 'order' ? 'active' : ''" id="order" wire:ignore.self>
                            <div class="card card-widget widget-user shadow-lg">
                                <div class="p-2">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody class="divide-y divide-gray-200 divide-solid">
                                            @forelse ($vendor->orders as $key => $order)
                                                <tr>
                                                    <x-table.data>
                                                        <div>{{ $key+1 }}</div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <img width="50" class="cursor-pointer img-circle" src="{{ asset('storage/' .$order->product->firstImage())}}" alt="">
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div class="badge badge-info">
                                                            {{ $order->order->code() }}
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            <label for="my-select">Action</label>
                                <br>
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div class="badge badge-success">
                                                            {{ $order->order->author()->name() }}
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div><span class="font-bold text-sm uppercase">Product:</span>
                                                            <br>
                                                            <span class="text-center font-bold badge badge-danger">
                                                                {{ $order->product->title() }}</div>
                                                            </span>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            <span class="font-bold text-sm uppercase">Price:</span>
                                                            <br>
                                                            <span class="text-center font-bold badge badge-danger">
                                                            {{ trans('global.naira') }}
                                                            {{ number_format($order->product->price(), 2) }}
                                                            </span>
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <span class="font-bold text-sm uppercase">Payment Type:</span>
                                                        <br>
                                                        @if ($order->order->payment() === 'pod')
                                                            <span class="text-center font-bold badge badge-danger">
                                                                Pay on Delivery
                                                            </span>
                                                        @elseif ($order->order->payment() === 'paystack')
                                                            <span class="text-center font-bold badge badge-danger">
                                                                Payment with Paystack
                                                            </span>
                                                        @else
                                                            <span class="text-center font-bold badge badge-danger">
                                                                Bought on loan
                                                            </span>
                                                        @endif
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            @foreach ($order->product->categories() as $category)
                                                                <p class="badge badge-info pl-1">
                                                                    {{ $category->name()}}
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </x-table.data>
                                                    <x-table.data>
                                                        <div>
                                                            <livewire:admin.setting.status :model='$order' :page='Request::url()' :key='$order->id()'>
                                                        </div>
                                                    </x-table.data>

                                                </tr>
                                            @empty
                                                <div class="text-center">
                                                    <span>
                                                        No data available
                                                    </span>
                                                </div>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" :class="currentTab === 'edit' ? 'active' : ''" id="edit" wire:ignore.self>
                            <div class="card card-widget widget-user shadow-lg">

                                    <div class="widget-user-header text-white" id="banner"
                                        style="background: url('{{ asset('storage/'.$vendor->banner()) }}') center center;"
                                        >
                                    </div>

                                    <div class="widget-user-image">
                                        <img class="img-circle" id="logo" src="{{ asset('storage/'.$vendor->image()) }}" alt="{{ $vendor->name() }}">
                                    </div>

                                    <div class="card-footer">

                                        <div class="col-sm-12">
                                            <div class="flex flex-row p-4 justify-center">
                                                    <x-buttons.custom id="uploadLogo">
                                                        {{ __('Add Logo') }}
                                                    </x-buttons.custom>

                                                    <x-buttons.custom id="uploadBanner">
                                                        {{ __('Add Banner') }}
                                                    </x-buttons.custom>
                                            </div>
                                        </div>
                                        <x-form action="{{ route('smilee.vendors.update',$vendor) }}" method="PUT" has-files>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input name="banner" type="file" id="bannerUpload" onchange="readBanner(this);" class="d-none">
                                                    <input name="image" type="file" id="logoUpload" onchange="readLogo(this);" class="d-none">
                                                </div>
                                                <div class="col-sm-6 mb-2">
                                                    <x-form.label for="name" value="{{ __('Business Name') }}" />
                                                    <x-form.input id="name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="name" :value="old('name', $vendor->name())" />
                                                    <x-form.error for="name" />
                                                </div>

                                                <div class="col-sm-6 mb-2">
                                                    <x-form.label for="phone" value="{{ __('Business Phone Number') }}" />
                                                    <x-form.input id="phone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="tel" name="phone" :value="old('phone', $vendor->phone())" />
                                                    <x-form.error for="phone" />
                                                </div>

                                                <div class="col-sm-6 mb-2">
                                                    <x-form.label for="email" value="{{ __('Business Email') }}" />
                                                    <x-form.input id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="email" name="email" :value="old('email', $vendor->email())" />
                                                    <x-form.error for="email" />
                                                </div>

                                                <div class="col-sm-6 mb-2">
                                                    <x-form.label for="categories" value="{{ __('Business Category') }}" />
                                                    <select name="categories[]" id="categories" x-data="{}" x-init="function () { choices($el) }" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" multiple>
                                                        @foreach ($categories as $id => $category)
                                                            <option value="{{ $category->id() }}" @if(in_array($id, $selectedTags)) selected @endif
                                                                >{{ $category->name() }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-form.error for="categories" />
                                                </div>

                                                <div class="col-sm-12 mb-2">
                                                    <x-form.label for="description" value="{{ __('Business Description') }}" />
                                                        <x-form.textarea id="description" class="block w-full mt-1" type="text" name="description">
                                                        {{ $vendor->description() }}
                                                    </x-form.textarea>
                                                    <x-form.error for="description" />
                                                </div>

                                                <div class="col-sm-6 mb-2">

                                                    <search-text-field/>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 p-4 space-y-4">
                                                        <div class="text-center">
                                                            <strong><i class="fas fa-globe mr-1"></i> Social Links</strong>
                                                        </div>

                                                        <hr>

                                                        <div class="col-sm-12">
                                                            <div class="row">

                                                                <div class="col-sm-6 mb-2">
                                                                    <x-form.label for="instagram" value="{{ __('Instagram') }}" />
                                                                    <x-form.input id="instagram" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="instagram" :value="old('instagram', $vendor->instagram())" />
                                                                    <x-form.error for="instagram" />
                                                                </div>

                                                                <div class="col-sm-6 mb-2">
                                                                    <x-form.label for="facebook" value="{{ __('Facebook') }}" />
                                                                    <x-form.input id="facebook" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="facebook" :value="old('facebook', $vendor->facebook())" />
                                                                    <x-form.error for="facebook" />
                                                                </div>

                                                                <div class="col-sm-6 mb-2">
                                                                    <x-form.label for="twitter" value="{{ __('Twitter') }}" />
                                                                    <x-form.input id="twitter" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="twitter" :value="old('twitter', $vendor->twitter())" />
                                                                    <x-form.error for="twitter" />
                                                                </div>

                                                                <div class="col-sm-6 mb-2">
                                                                    <x-form.label for="linkedin" value="{{ __('Linkedin') }}" />
                                                                    <x-form.input id="linkedin" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="linkedin" :value="old('linkedin', $vendor->linkedin())" />
                                                                    <x-form.error for="linkedin" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="flex flex-row space-x-4 justify-end">
                                                <x-buttons.primary class="form_nav_actions">
                                                    {{ __('Save') }}
                                                </x-buttons.primary>
                                            </div>
                                        </x-form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            $('#uploadLogo').click(function(){
                $('#logoUpload').trigger('click');
            })

            $('#uploadBanner').click(function(){
                $('#bannerUpload').trigger('click');
            })
        </script>

        <script type="text/javascript">
            function readLogo(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#logo')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script type="text/javascript">
            function readBanner(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#banner')
                            .attr('url', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        {{-- <script>
            $(document).on('submit', '#updateVendorInformation', function (event) {

                loadSpinner('.form_nav_actions', 'continue');
                event.preventDefault();

                const obj = {
                    hello: "world";
                };

                const json = JSON.stringify(obj);
                const blob = new Blob([json], {
                    type: 'application/json'
                });

                let data = $(this).serialize();
                var file = document.querySelector('#file');
                data.append("file", file.files[0]);
                data.append("document", blob);

                axios.put("{{ route('smilee.vendors.update', $vendor)}}", data)
                .then( data => {

                    Notiflix.Report.Success('Updating Success', data.data.success, 'ok')
                        setTimeout( function () {
                            window.location = data.data.redirect_link;
                    }, 2000);

                    removeSpinner('.form_nav_actions', 'continue');
                })
                .catch( error => {

                    printErrorMsg(error.response.data.error);
                    removeSpinner('.form_nav_actions', 'continue');

                });
            });

            function  loadSpinner(item) {

                $(item).attr('disabled',  true);
                $(item).html('<div class="Ids-ellipsis"><div></div><div></div><div></div>');
            }


            function  removeSpinner(item, message) {

                $(item).attr('disabled',  false);
                $(item).html(message);
            }

        </script> --}}
    @endpush
</div>
