<div class="overflow-hidden border-b border-gray-200 p-2">
    {{-- <x-alerts.loading/> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 offset-md-1">
                    <div class="row">
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
                                    Search by semester
                                </x-slot>
                                <x-slot name="option">
                                    <select id="my-select" class="form-control" wire:model="semester">
                                        <option value="">Select</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->name }}"></option>
                                        @endforeach
                                    </select>
                                </x-slot>
                            </x-box.status>
                        </div>

                        <div class="col-md-3">
                            <x-box.status>
                                <x-slot name="label">
                                    Search by level
                                </x-slot>
                                <x-slot name="option">
                                    <select id="my-select" class="form-control" wire:model="level">
                                        <option value="">Select</option>
                                        @foreach($levels as $level)
                                            <option value="{{ $level->name }}"></option>
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
                            <div class="mt-1">
                                <x-link.main href="{{ route('admin.banks.create') }}">
                                    Create
                                </x-link.main>
                            </div>
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
                                    {{ Illuminate\Support\Str::plural('writer', count($selectedRows)) }}
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
                                <x-table.head>Name</x-table.head>
                                <x-table.head>Description</x-table.head>
                                <x-table.head class="text-center">
                                    Added By
                                </x-table.head>
                            </tr>
                        </thead>
        
                        <tbody class="divide-y divide-gray-200 divide-solid">
                            @foreach($banks as $bank)
                                <tr>
                                    <x-table.data>
                                        <div class="ml-2 icheck-primary d-inline">
                                            <input wire:model="selectedRows" type="checkbox" value="{{ $bank->id() }}"
                                                name="todo2" id="{{ $bank->id() }}">
                                            <label for="{{ $bank->id() }}"></label>
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>{{ $bank->name() }}</div>
                                    </x-table.data>
                                    <x-table.data class="text-center">
                                        <div>
                                            {{ $bank->excerpt(100) }}
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div class="text-center">
                                            <span class="p-2">
                                                {{ $bank->author()->name }}
                                            </span>
                                        </div>
                                    </x-table.data>
                                    <x-table.data>
                                        <div>
                                            <button class="text-red-800 bg-gray-100 btn" title="Click to preview" 
                                            data-toggle="modal" data-target="#preview{{ $bank->id}}" >
                                                <i class="fa fa-eye"></i> Show Material
                                            </button>
                                        </div>
                                        @include('livewire.admin.order+.preview')
                                    </x-table.data>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $banks->links() }}
        </div>
    </div>    
</div>
