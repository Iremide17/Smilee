<div class="modal fade" id="preview{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-info">
                    {{  $order->orderDetails->count() }}
                    {{ Illuminate\Support\Str::plural('Product', count( $order->orderDetails)) }}
                </h5>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        g
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>h