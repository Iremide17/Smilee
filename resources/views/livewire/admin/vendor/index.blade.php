<div class="overflow-hidden border-b border-gray-200 p-2">
    {{-- <x-alerts.loading/> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 offset-md-1">
                    <div class="row">
                        <div class="col-md-3">
                            <x-box.search>
                                <x-slot name="label">
                                    Type keywords to search for vendors
                                </x-slot>
                                <x-slot name="datalist">
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->name }}"></option>
                                    @endforeach
                                </x-slot>
                            </x-box.search>
                        </div>
        
                        <div class="col-md-3">
                            <x-box.perPage>
                                <x-slot name="label">
                                    Per Page
                                </x-slot>
                            </x-box.perPage>
                        </div>
        
                        <div class="col-md-3">
                            <x-box.status>
                                <x-slot name="label">
                                    Search by status
                                </x-slot>
                                <x-slot name="option">
                                    <select id="my-select" class="form-control" wire:model="status">
                                        <option value="">Select</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->name }}"></option>
                                        @endforeach
                                    </select>
                                </x-slot>
                            </x-box.status>
                        </div>
        
                        <div class="col-md-3">
                            <x-box.reset>
                                <x-slot name="label">
                                    Reset <i class="fa fa-search" aria-hidden="true"></i>
                                </x-slot>
                            </x-box.reset>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            @if($selectedRows)
                                <label for="my-select">Action</label>
                                <br>
        
                                <div class="rounded text-gray-50 btn-group">
                                    <button type="button" class="bg-blue-500 text-gray-50 btn btn-default">Bulk Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a wire:click.prevent="deleteAll" class="dropdown-item" href="#"> <i
                                                class="text-red-600 fa fa-trash" aria-hidden="true"></i> Delete Selected</a>
                                        <a wire:click.prevent="markAllAsVerify" class="dropdown-item" href="#"><i
                                                class="text-green-600 fa fa-check" aria-hidden="true"></i> Set all as
                                            verified</a>
                                        <a wire:click.prevent="markAllAsBan" class="dropdown-item" href="#"><i
                                                class="text-purple-600 fa fa-check" aria-hidden="true"></i> Set all as
                                            Banned</a>
                                        <a wire:click.prevent="markAllAsReject" class="dropdown-item" href="#"><i
                                                class="text-yellow-600 fa fa-check" aria-hidden="true"></i> Set all as
                                            rejected</a>
                                        <a wire:click.prevent="markAllAsProcess" class="dropdown-item" href="#"><i
                                                class="text-blue-600 fa fa-check" aria-hidden="true"></i> Set all as
                                            processed</a>
                                        <a wire:click.prevent="markAllAsAccept" class="dropdown-item" href="#"><i
                                                class="text-blue-600 fa fa-check" aria-hidden="true"></i> Set all as
                                            accepted</a>
                                    </div>
                                </div>
        
                                <span class="ml-1"> {{ count($selectedRows) }}
                                    {{ Illuminate\Support\Str::plural('vendor', count($selectedRows)) }}
                                    Selected
                                </span>
        
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
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
                                <x-table.head>User</x-table.head>
                                <x-table.head>Name</x-table.head>
                                <x-table.head>Phone</x-table.head>
                                <x-table.head>Products</x-table.head>
                                <x-table.head class="text-center">
                                    Status
                                </x-table.head>
                            </tr>
                        </thead>
        
                        <tbody class="divide-y divide-gray-200 divide-solid">
                            @foreach($vendors as $vendor)
                                <tr>
                                    <x-table.data>
                                        <div class="ml-2 icheck-primary d-inline">
                                            <input wire:model="selectedRows" type="checkbox" value="{{ $vendor->id() }}"
                                                name="todo2" id="{{ $vendor->id() }}">
                                            <label for="{{ $vendor->id() }}"></label>
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>{{ $vendor->user()->name() }}</div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>{{ $vendor->name() }}</div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>
                                            {{ $vendor->phone() }}
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div class="font-bold text-lg text-center">
                                            <p class="badge badge-info cursor-pointer" title="Click to preview" 
                                            data-toggle="modal" data-target="#product{{ $vendor->id}}">
                                                {{ $vendor->products->count() }}
                                            </p>
                                        </div>
                                        @include('livewire.admin.vendor.preview')
                                    </x-table.data>
                                    <x-table.data>
                                        <div class="text-center">
                                            <span class="p-2">
                                                {{ $vendor->status->name }}
                                            </span>
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="bg-blue-500 text-gray-50 btn">Action</button>
                                                    <button type="button"
                                                        class="text-white bg-blue-500 btn dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
        
                                                        @if($vendor->status_id == 1)
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="process({{ $vendor->id }})"
                                                                    class="text-blue-600">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i> Reject
                                                                    vendor
                                                                </span>
                                                            </a>
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="accept({{ $vendor->id }})"
                                                                    class="text-green-600">
                                                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Accept
                                                                    vendor
                                                                </span>
                                                            </a>
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="verify({{ $vendor->id }})"
                                                                    class="text-green-600">
                                                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Verify
                                                                    vendor
                                                                </span>
                                                            </a>
                                                        @elseif($vendor->status_id == 2 || $vendor->status_id == 3)
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="reject({{ $vendor->id }})"
                                                                    class="text-red-600">
                                                                    <i class="fa fa-times-circle" aria-hidden="true"></i> Reject
                                                                    vendor
                                                                </span>
                                                            </a>
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="verify({{ $vendor->id }})"
                                                                    class="text-green-600">
                                                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Verify
                                                                    vendor
                                                                </span>
                                                            </a>
                                                        @elseif($vendor->status_id == 5)
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="delete({{ $vendor->id }})"
                                                                    class="text-red-600">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete vendor
                                                                </span>
                                                            </a>
                                                        @elseif($vendor->status_id == 4)
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="ban({{ $vendor->id }})"
                                                                    class="text-info-600">
                                                                    <i class="fa fa-times" aria-hidden="true"></i> Ban vendor
                                                                </span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="delete({{ $vendor->id }})"
                                                                    class="text-red-600">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                                    vendor's Account
                                                                </span>
                                                            </a>
                                                        @elseif($vendor->status_id == 6)
        
                                                            <a class="dropdown-item" href="#">
                                                                <span wire:click.prevent="verify({{ $vendor->id }})"
                                                                    class="text-green-600">
                                                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Unban
                                                                    vendor
                                                                </span>
                                                            </a>
                                                        @endif
        
                                                    </div>
                                                </div>
                                            </td>
                                        </div>
                                    </x-table.data>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $vendors->links() }}
        </div>
    </div>    
</div>