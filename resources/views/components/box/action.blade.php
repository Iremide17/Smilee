<div class="btn-group">
    <button type="button" class="btn {{ $model->status_btn }} text-white">{{ $model->status->name }}</button>
    <button type="button" class="btn {{ $model->status_btn }} dropdown-toggle dropdown-icon" data-toggle="dropdown">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">
        @if ($model->status_id == 1)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="process({{ $model->id() }})" class="text-red-600">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Process 
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="accept({{ $model->id() }})" class="text-blue-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Accept
                </span>
            </a>
        @elseif ($model->status_id == 2)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="accept({{ $model->id() }})" class="text-blue-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Accept 
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="verify({{ $model->id() }})" class="text-green-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Verify 
                </span>
            </a>
        @elseif ($model->status_id == 3)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="accept({{ $model->id() }})" class="text-blue-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Accept
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="verify({{ $model->id() }})" class="text-green-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Verify 
                </span>
            </a>
        @elseif ($model->status_id == 4)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="ban({{ $model->id() }})" class="text-purple-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Ban 
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="delete({{ $model->id() }})" class="text-red-600">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete 
                </span>
            </a>
        @elseif ($model->status_id == 5)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="process({{ $model->id() }})" class="text-blue-600">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> Process
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="verify({{ $model->id() }})" class="text-green-600">
                    <i class="fa fa-check" aria-hidden="true"></i> Verify
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="delete({{ $model->id() }})" class="text-red-600">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete 
                </span>
            </a>
        @elseif ($model->status_id == 6)
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="unban({{ $model->id() }})" class="text-yellow-600">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> Unban
                </span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
                <span wire:click.prevent="delete({{ $model->id() }})" class="text-red-600">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                </span>
            </a>
        @endif
    </div>
</div>