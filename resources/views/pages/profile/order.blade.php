<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
           {{ $user->username() }} 
           {{ Illuminate\Support\Str::plural('Order', count($orders)) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-body p-0">
                      <div class="table-responsive mailbox-messages">
                        <div class="table-wrapper">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="bg-blue-500">
                                    <tr>
                                        <x-table.head>
                                            Product Name
                                        </x-table.head>
                                        <x-table.head class="text-center">
                                            Price
                                        </x-table.head>
                                        <x-table.head class="text-center">
                                            Date
                                        </x-table.head>
                                        <x-table.head class="text-center">
                                            Status
                                        </x-table.head>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 divide-solid">
                                    @forelse ($orders as $order)
                                        <tr class="text-center">
                                            <x-table.data>
                                                <div>
                                                    <ul>
                                                        @foreach ($order->orderDetails as $detail)
                                                                <li>
                                                                    <p class="font-bold text-sm text-blue-500">
                                                                        {{ $detail->product->title() }}
                                                                    </p>
                                                                </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </x-table.data>
                                            <x-table.data>
                                                <div class="font-bold text-sm text-blue-500">
                                                    {{ trans('global.naira') }}{{ number_format($order->total(),2) }}
                                                </div>
                                            </x-table.data>
                                            <x-table.data>
                                                <div class="font-bold text-sm text-blue-500">
                                                    {{ $order->createdAtDate() }}
                                                </div>
                                            </x-table.data>
                                            <x-table.data>
                                                <span class="p-2 {{ $order->status_badge }} badge">
                                                    {{ $order->status->name }} <sup class="p-2 m-2 font-bold bg-white rounded"> order</sup>
                                                </span>
                                            </x-table.data>
                                        </tr>
                                    @empty
                                        <span class="m-4 text-center">
                                            {{ $vendor->name() }}, no product in your order list!
                                        </span>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>               
                      </div>

                    </div>
                  </div>
            </section>
        </div>
    </div>
</x-app-layout>

