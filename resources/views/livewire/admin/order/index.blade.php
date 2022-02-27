<div class="overflow-hidden border-b border-gray-200 p-2">

    <x-alerts.loading/>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <x-box.search>
                        <x-slot name="label">
                            Type keywords to search for order
                        </x-slot>
                        <x-slot name="datalist">
                            @foreach($orders as $order)
                                <option value="{{ $order->code() }}"></option>
                            @endforeach
                        </x-slot>
                    </x-box.search>
                </div>

                <div class="col-md-4">
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
                            {{ Illuminate\Support\Str::plural('Order', count($selectedRows)) }}
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

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
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
                                    <x-table.head>Order Code</x-table.head>
                                    <x-table.head>Order Total Price</x-table.head>
                                    <x-table.head>Payment Type</x-table.head>
                                    <x-table.head>Details</x-table.head>
                                    <x-table.head>Author</x-table.head>
                                    <x-table.head class="text-center">Actions</x-table.head>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <x-table.data>
                                            <div class="ml-2 icheck-primary d-inline">
                                                <input wire:model="selectedRows" type="checkbox" value="{{ $order->id() }}"
                                                    name="todo2" id="{{ $order->id() }}">
                                                <label for="{{ $order->id() }}"></label>
                                            </div>
                                        </x-table.data>
                                        <x-table.data>
                                            <div>{{ $order->code() }}</div>
                                        </x-table.data>
                                        <x-table.data>
                                            <div>
                                                {{ trans('global.naira') }}
                                                {{ number_format($order->total(), 2) }}
                                            </div>
                                        </x-table.data>
                                        <x-table.data>
                                            @if ($order->payment() === 'pod')
                                                <span class="text-center font-bold badge badge-danger">
                                                    Pay on Delivery
                                                </span>
                                            @elseif ($order->payment() === 'paystack')
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
                                                <span class="btn btn-primary rounded-xl">
                                                    {{  $order->orderDetails->count() }}
                                                    {{ Illuminate\Support\Str::plural('Product', count( $order->orderDetails)) }}
                                                </span>
                                            </div>
                                        </x-table.data>
                                        <x-table.data>
                                            <div>{{ $order->author()->name() }}</div>
                                        </x-table.data>
                                        <x-table.data>
                                            <div>{{ $order->createdAtDate() }}</div>
                                        </x-table.data>
                                    </tr>
                                    <tr class="expandable-body d-none">
                                        <td colspan="6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @foreach ($order->orderDetails as $key => $orderDetail)
                                                        <div class="row flex flex-row justify-center mb-1">
                                                            <div class="col-md-1">
                                                                <p>
                                                                     {{ $key+1 }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <p>
                                                                    {{ $orderDetail->vendor->name() }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <p>
                                                                    {{ $orderDetail->product->title() }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p>
                                                                    {{ trans('global.naira') }}{{ $orderDetail->price() }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                @foreach ($orderDetail->product->categories() as $category)
                                                                    <p class="badge badge-info pl-1">
                                                                        {{ $category->name()}}
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="col-md-2">
                                                                <livewire:admin.setting.status :model='$orderDetail' :page='Request::url()' :key='$orderDetail->id()'>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div>
                                                                    <x-buttons.default data-toggle="modal" data-target="#track{{ $orderDetail->id }}">
                                                                        Track Order
                                                                    </x-buttons.defau>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- modal track --}}
                                                        @include('livewire.admin.order.track')
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="flex justify-center">
                                        <span class="text-center">
                                            No data available
                                        </span>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <style>

            .steps .step {
                display: block;
                width: 100%;
                margin-bottom: 35px;
                text-align: center
            }

            .steps .step .step-icon-wrap {
                display: block;
                position: relative;
                width: 100%;
                height: 80px;
                text-align: center
            }

            .steps .step .step-icon-wrap::before,
            .steps .step .step-icon-wrap::after {
                display: block;
                position: absolute;
                top: 50%;
                width: 50%;
                height: 3px;
                margin-top: -1px;
                background-color: #e1e7ec;
                content: '';
                z-index: 1
            }

            .steps .step .step-icon-wrap::before {
                left: 0
            }

            .steps .step .step-icon-wrap::after {
                right: 0
            }

            .steps .step .step-icon {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
                border: 1px solid #e1e7ec;
                border-radius: 50%;
                background-color: #f5f5f5;
                color: #374250;
                font-size: 38px;
                line-height: 81px;
                z-index: 5
            }

            .steps .step .step-title {
                margin-top: 16px;
                margin-bottom: 0;
                color: #606975;
                font-size: 14px;
                font-weight: 500
            }

            .steps .step:first-child .step-icon-wrap::before {
                display: none
            }

            .steps .step:last-child .step-icon-wrap::after {
                display: none
            }

            .steps .step.completed .step-icon-wrap::before,
            .steps .step.completed .step-icon-wrap::after {
                background-color: #0da9ef
            }

            .steps .step.completed .step-icon {
                border-color: #0da9ef;
                background-color: #0da9ef;
                color: #fff
            }

            @media (max-width: 576px) {
                .flex-sm-nowrap .step .step-icon-wrap::before,
                .flex-sm-nowrap .step .step-icon-wrap::after {
                    display: none
                }
            }

            @media (max-width: 768px) {
                .flex-md-nowrap .step .step-icon-wrap::before,
                .flex-md-nowrap .step .step-icon-wrap::after {
                    display: none
                }
            }

            @media (max-width: 991px) {
                .flex-lg-nowrap .step .step-icon-wrap::before,
                .flex-lg-nowrap .step .step-icon-wrap::after {
                    display: none
                }
            }

            @media (max-width: 1200px) {
                .flex-xl-nowrap .step .step-icon-wrap::before,
                .flex-xl-nowrap .step .step-icon-wrap::after {
                    display: none
                }
            }

            .bg-faded, .bg-secondary {
                background-color: #f5f5f5 !important;
            }

        </style>
    @endpush
</div>
