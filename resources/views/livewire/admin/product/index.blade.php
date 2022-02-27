<div class="overflow-hidden border-b border-gray-200 p-2">

    <x-alerts.loading/>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <x-box.search>
                        <x-slot name="label">
                            Type keywords to search for Product
                        </x-slot>
                        <x-slot name="datalist">
                            @foreach($products as $product)
                                <option value="{{ $product->title() }}"></option>
                            @endforeach
                        </x-slot>
                    </x-box.search>
                </div>

                <div class="col-md-1">
                    <x-box.perPage>
                        <x-slot name="label">
                            Per Page
                        </x-slot>
                    </x-box.perPage>
                </div>

                <div class="col-md-4">
                    @if($selectedRows)
                    
                        <div class="rounded text-gray-50 btn-group">
                            <button type="button" class="bg-blue-500 text-gray-50 btn btn-default">Bulk Actions</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a wire:click.prevent="deleteAll" class="dropdown-item" href="#"> <i
                                        class="text-red fa fa-trash" aria-hidden="true"></i> Delete Selected</a>
                                <a wire:click.prevent="markAllAsVerify" class="dropdown-item" href="#"><i
                                        class="text-green fa fa-check" aria-hidden="true"></i> Set all as
                                    verified</a>
                                <a wire:click.prevent="markAllAsBan" class="dropdown-item" href="#"><i
                                        class="text-purple fa fa-check" aria-hidden="true"></i> Set all as
                                    Banned</a>
                                <a wire:click.prevent="markAllAsReject" class="dropdown-item" href="#"><i
                                        class="text-yellow fa fa-check" aria-hidden="true"></i> Set all as
                                    rejected</a>
                                <a wire:click.prevent="markAllAsProcess" class="dropdown-item" href="#"><i
                                        class="text-blue fa fa-check" aria-hidden="true"></i> Set all as
                                    processed</a>
                                <a wire:click.prevent="markAllAsAccept" class="dropdown-item" href="#"><i
                                        class="text-blue fa fa-check" aria-hidden="true"></i> Set all as
                                    accepted</a>
                            </div>
                        </div>

                        <span class="ml-1"> {{ count($selectedRows) }}
                            {{ Illuminate\Support\Str::plural('product', count($selectedRows)) }}
                            Selected
                        </span>

                    @endif
                </div>

                <div class="col-md-2">
                    <x-box.reset>
                        <x-slot name="label">
                            Reset <i class="fa fa-search" aria-hidden="true"></i>
                        </x-slot>
                    </x-box.reset>
                </div>
                <div class="col-md-2">
                    <x-link.main href="{{ route('vendor.product.create') }}">
                        Create Product
                    </x-link.main>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-none shadow-sm">
                    <div class="row flex justify-center">
                        <div class="border-blue rounded btn-group btn-sm">
                            <button wire:click="filterProductByStatus" class="border btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info">{{ $productsCount }}</span>
                            </button>
    
                            <button wire:click="filterProductByStatus('Pending')" class="border border-gray btn {{ ($status === 'Pending') ? 'bg-gray text-gray-50' : 'btn-default' }}">
                                <span class="mr-1">Pending</span>
                                <span class="badge badge-pill badge-primary">{{ $pendingProductscount }}</span>
                            </button>
    
                            <button wire:click="filterProductByStatus('Processing')" class="border border-yellow btn {{ ($status === 'Processing') ? 'bg-yellow text-gray-50' : 'btn-default' }}">
                                <span class="mr-1">Process</span>
                                <span class="badge badge-pill badge-primary">{{ $processProductsCount }}</span>
                            </button>
    
                            <button wire:click="filterProductByStatus('Accepted')" class="border border-blue btn {{ ($status === 'Accepted') ? 'bg-blue text-gray-50' : 'btn-default' }}">
                                <span class="mr-1">Accepted</span>
                                <span class="badge badge-pill badge-primary">{{ $acceptedProductsCount }}</span>
                            </button>
    
                            <button wire:click="filterProductByStatus('Verified')" class="border border-green btn {{ ($status === 'Verified') ? 'bg-green text-gray-50' : 'btn-default' }}">
                                <span class="mr-1">Verified</span>
                                <span class="badge badge-pill badge-primary">{{ $verifiedProductsCount }}</span>
                            </button>
    
                            <button wire:click="filterProductByStatus('Rejected')" class="border border-red btn {{ ($status === 'Rejected') ? 'bg-red text-gray-50' : 'btn-default' }}">
                                <span class="mr-1">Rejected</span>
                                <span class="badge badge-pill badge-primary">{{ $rejectedProductsCount }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <div class="table-wrapper">
                            <table class="table table-bordered table-striped table-hover">
        
                                <thead class="bg-blue-500">
                                    <tr>
                                        <x-table.head>
                                            <div class="ml-2 icheck-primary d-inline">
                                                <input wire:model="selectPageRows" type="checkbox" value="" name="todo2"
                                                    id="todoCheck2">
                                                <label for="todoCheck2"></label>
                                            </div>
                                        </x-table.head>
                                        <x-table.head>Image</x-table.head>
                                        <x-table.head>Product Name</x-table.head>
                                        <x-table.head>Product Code</x-table.head>
                                        <x-table.head>Product Price</x-table.head>
                                        <x-table.head>Product Type</x-table.head>
                                        <x-table.head>Vendor</x-table.head>
                                        <x-table.head>Category</x-table.head>
                                        <x-table.head class="text-center">Actions</x-table.head>
                                    </tr>
                                </thead>
        
                                <tbody class="divide-y divide-gray-200 divide-solid">
                                    @foreach($products as $product)
                                        <tr>
                                            <x-table.data>
                                                <div class="ml-2 icheck-primary d-inline">
                                                    <input wire:model="selectedRows" type="checkbox" value="{{ $product->id() }}"
                                                        name="todo2" id="{{ $product->id() }}">
                                                    <label for="{{ $product->id() }}"></label>
                                                </div>
                                            </x-table.data>
                                            <x-table.data>
                                                <img width="50" class="cursor-pointer img-circle"
                                                    src="{{ asset('storage/' .$product->firstImage()) }}"
                                                    alt="">
                                            </x-table.data>
                                            <x-table.data>
                                                <div>{{ $product->title() }}</div>
                                            </x-table.data>
                                            <x-table.data>
                                                <div class="font-bold text-ellipsis">{{ $product->code() }}</div>
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
                                                <div>{{ $product->vendor->name() }}</div>
                                            </x-table.data>
                                            <x-table.data>
                                                <div>
                                                    @foreach($product->categories() as $category)
                                                        <p class="badge badge-info pl-1">
                                                            {{ $category->name() }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </x-table.data>
                                            <x-table.data>
                                                <div class="flex justify-center space-x-4">
        
                                                    <x-link.secondary
                                                        href="{{ route('vendor.product.edit', $product) }}">
                                                        <x-zondicon-edit-pencil class="w-5 h-5" />
                                                    </x-link.secondary>
        
                                                    <livewire:admin.setting.status :model='$product' :page='Request::url()' :key='$product->id()'>
        
                                                </div>
                                            </x-table.data>
        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
