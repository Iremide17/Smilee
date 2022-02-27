
<div class="overflow-hidden border-b border-gray-200 p-2">
    <x-alerts.loading/>

    <div class="row mb-4 p-2">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-2">
                    <label for="my-select">Type
                        @if($type != null) <a wire:click="clearSearchTypeFilter">
                            <i class="fa fa-times text-red-500 text-sm ml-2 cursor-pointer" aria-hidden="true">clear</i></a> @endif
                    </label>
                    <select id="my-select" class="form-control" wire:model="type">
                            <option>Select Option</option>
                            <option value="1">Admin</option>
                            <option value="2">Agent</option>
                            <option value="3">Writer</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="my-select">Search
                        @if($searchTerm != null) <a wire:click="clearSearchTermFilter">
                        <i class="fa fa-times text-red-500 text-sm ml-2 cursor-pointer" aria-hidden="true">clear</i></a> @endif
                    </label>
                    <input type="text" class="form-control w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" wire:model.debounce.350ms="searchTerm" placeholder="Enter name...">
                </div>

                <div class="col-md-2">
                    <label for="my-select">Sort By</label>
                    <select id="my-select" class="form-control" wire:model="sortBy">
                        <option value="asc">ASC</option>
                        <option value="desc">DESC</option>

                    </select>
                </div>

                <div class="col-md-2">
                    <label for="my-select">Per Page</label>
                    <select id="my-select" class="form-control" wire:model="per_page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="col-md-4">
                    @if ($selectedRows)
                        <label for="my-select">Action</label>
                        <br>

                        <div class="rounded text-gray-50 btn-group">
                            <button type="button" class="bg-blue-500 text-gray-50 btn btn-default">Bulk Actions</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                            <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#"> <i class="text-red-600 fa fa-trash" aria-hidden="true"></i> Delete Selected</a>
                            <a wire:click.prevent="markAllAsAdmin" class="dropdown-item" href="#"><i class="text-green-600 fa fa-check" aria-hidden="true"></i> Set all as Admin</a>
                            <a wire:click.prevent="markAllAsSeller" class="dropdown-item" href="#"><i class="text-purple-600 fa fa-check" aria-hidden="true"></i> Set all as Seller</a>
                            <a wire:click.prevent="markAllAsWriter" class="dropdown-item" href="#"><i class="text-yellow-600 fa fa-check" aria-hidden="true"></i> Set all as Writer</a>
                            </div>
                        </div>

                        <span class="ml-1"> {{ count($selectedRows) }}
                            {{ Illuminate\Support\Str::plural('user', count($selectedRows)) }} Selected
                        </span>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>
                            <div class="ml-2 icheck-primary d-inline">
                                <input wire:model="selectPageRows"  type="checkbox" value="" name="todo2" id="todoCheck2">
                                <label for="todoCheck2"></label>
                            </div>
                        </x-table.head>
                        <x-table.head>Name</x-table.head>
                        <x-table.head>Email</x-table.head>''
                        <x-table.head class="text-center">Role</x-table.head>
                        <x-table.head class="text-center">Joined Date</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    @foreach ($users as $user)
                        <tr>
                            <x-table.data>
                                <div class="ml-2 icheck-primary d-inline">
                                    <input wire:model="selectedRows" type="checkbox" value="{{ $user->id() }}" name="todo2" id="{{ $user->id() }}">
                                    <label for="{{ $user->id() }}"></label>
                                </div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $user->name() }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div>{{ $user->emailAddress() }}</div>
                            </x-table.data>
                            <x-table.data>
                                <div class="px-2 py-1 text-center text-gray-700 bg-green-200 rounded">
                                    <select wire:change="changeUser({{$user}}, $event.target.value)"
                                        class="form-control w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="1" @if($user->type() === 1) selected @endif>Admin</option>
                                        <option value="2" @if($user->type() === 2) selected @endif>Super Administrator</option>
                                        <option value="3" @if($user->type() === 3) selected @endif>Agent</option>
                                        <option value="4" @if($user->type() === 4) selected @endif>Writer</option>
                                        <option value="5" @if($user->type() === 5) selected @endif>Vendor</option>
                                        <option value="6" @if($user->type() === 6) selected @endif>Default</option>
                                    </select>
                                </div>
                            </x-table.data>
                            <x-table.data>
                                <div class="text-center">{{ $user->createdAtDate() }}</div>
                            </x-table.data>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->links() }}
</div>
