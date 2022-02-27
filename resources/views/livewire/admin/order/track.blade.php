<div class="modal right fade" id="track{{ $orderDetail->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header flex flex-row justify-end">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="container padding-bottom-3x mb-1">
                    <div class="card mb-3">
                        <div class="p-4 text-center text-white text-lg bg-primary rounded-top">
                            <span class="text-uppercase">Tracking Order No - </span>
                            <span class="text-medium"> {{ $orderDetail->trackingCode() }}</span>
                        </div>

                        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-success">
                            <div class="w-100 text-center py-1 px-2"><span class="text-medium">
                                Shipped Via:</span> UPS Ground
                            </div>
                            <div class="w-100 text-center py-1 px-2"><span class="text-medium">
                                    Status:
                                </span> Checking Quality
                            </div>
                            <div class="w-100 text-center py-1 px-2">
                                <span class="text-medium">Delivery Date:</span> SEP 09, 2017
                            </div>
                        </div>

                        <div class="card-body">
                            <x-box.tracker/>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-sm-between align-items-center">
                        <div class="custom-control custom-checkbox mr-3">
                        <input class="custom-control-input" type="checkbox" id="notify_me" checked="">
                        <label class="custom-control-label" for="notify_me">Notify me when order is delivered</label>
                        </div>
                        <div class="text-left text-sm-right"><a class="btn btn-outline-primary btn-rounded btn-sm" href="orderDetails" data-toggle="modal" data-target="#orderDetails">View Order Details</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
