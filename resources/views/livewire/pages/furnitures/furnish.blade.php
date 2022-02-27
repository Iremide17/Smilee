<div>
    <div class="row">
        <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($furnishs['furnitures']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($furnishs['furnitures'] as $key => $furniture)
                                            <tr class="text-center font-bold text-sm">
                                                <td>
                                                    <div>
                                                        {{ $key+1 }}.
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <img src="{{ asset('storage/'. $furniture->firstImage()) }}"
                                                        width="50"
                                                        class="img img-circle"
                                                        alt="{{ $furniture->title()}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{ $furniture->title()}}</p>
                                                </td>
                                                <td>
                                                    <p>
                                                        {{ $furniture->vendor->name() }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <p>
                                                            {{ trans('global.naira') }} {{ $furniture->price() }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="#" wire:click="removeFromFurnish({{ $furniture->id }})">
                                                            <span class="fa fa-times"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center font-bold text-lg">
                                <span>
                                    You have no furnishing furnitures.
                                </span>
                            </div>
                        @endif
                    </div>
                    @if(count($furnishs['furnitures']) > 0)
                        <div class="col-md-12">
                            <div class="text-center font-bold text-lg uppercase p-2">
                                <h1>Order Summary</h1>
                            </div>
                            
                            <x-box.order :model="$furnishs['furnitures']" :total="$total" :sub="$subTotal" :ship="$shipping"/>
                        </div>
                    @endif
                </div>
            
        </div>

        <div class="col-md-4">
           <div class="row">
                <x-box.summary :model="$furnishs['furnitures']" :total="$total" :sub="$subTotal" :ship="$shipping" :states="$states"/>
           </div>
        </div>
    </div>
</div>
