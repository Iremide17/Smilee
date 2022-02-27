<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Agent Dashboard') }}
        </h2>
        <p>
            Welcome to your dashboard {{ auth()->user()->name() }}!
        </p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            
            <div class="container-fluid">
                <div class="row p-4">
                    <div class="col-md-3 col-6">
                         <x-box.case class="bg-info">
                             <x-slot name="count">
                                 {{ count($bookings) }}
                             </x-slot>
     
                             <x-slot name="body">
                                {{ Illuminate\Support\Str::plural('Booking', count($bookings)) }}
                             </x-slot>
     
                             <x-slot name="icon">
                                 <i class="fa fa-home" aria-hidden="true"></i>
                             </x-slot>
     
                             <x-slot name="link">
                                 <a href="{{ route('agent.bookings.index',auth()->user()->agent) }}" 
                                    class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                             </x-slot>
                         </x-box.case>
                    </div>
                </div>
            </div>
              
        </div>
    </div>
</x-app-layout>