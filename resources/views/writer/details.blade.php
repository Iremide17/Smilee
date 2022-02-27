<div class="modal fade" id="preview{{ $writer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-info">Writer</h5>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</dt>
                    <dd class="col-sm-8">{{ $writer->facebook() }}</dd>
                    <dt class="col-sm-4"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter </dt>
                    <dd class="col-sm-8">{{ $writer->twitter() }}</dd>
                    <dt class="col-sm-4"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</dt>
                    <dd class="col-sm-8">{{ $writer->instagram() }}</dd>
                    <dt class="col-sm-4"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</dt>
                    <dd class="col-sm-8">{{ $writer->linkedin() }}</dd>
                </dl>

                <div class="p-6">
                    <dl class="mt-2">
                        <dt>Bio</dt>
                        <dd>
                            <p>
                                {{ $writer->bio() }}
                            </p>
                        </dd>
                    </dl>
                </div>

                <div class="">
                    
                </div>

            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>