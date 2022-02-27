<div class="modal fade" id="preview{{ $bank->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-info">Preview</h5>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="overflow-hidden d-flex justify-content-center responsive-container">
                    <iframe src="{{ asset('storage/'.$bank->content) }}" frameborder="0" width="850" height="550" style="border: 0;"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>