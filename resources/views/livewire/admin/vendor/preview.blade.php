<div class="modal fade" id="product{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-info">Vendor Products</h5>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav flex-column">
                            @forelse ($vendor->products as $key => $product)
                                <li class="nav-item">
                                    
                                    <div class="flex flex-row space-x-8">
                                        <div>
                                            ({{ $key+1 }}).
                                        </div>

                                        <div>
                                            {{ $product->title() }} ({{ trans('global.naira') }}{{ $product->price() }})
                                        </div>
                                        <div>
                                            @foreach ($product->categories() as $category)
                                                <p class="badge badge-info pl-1">
                                                    {{ $category->name()}}
                                                </p>
                                            @endforeach 
                                        </div>
                                    </div>
                                    <span class="float-right">
                                        <div>
                                            <livewire:admin.setting.status :model='$product' :page='Request::url()' :key='$product->id()'>
                                        </div>
                                    </span>
                                </li>
                            @empty
                                <div class="font-bold text-center">
                                    <span>
                                        No data available
                                    </span>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>