<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Admin Dashboard') }}
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
                                 {{ count($users) }}
                             </x-slot>
     
                             <x-slot name="body">
                                {{ Illuminate\Support\Str::plural('User', count($users)) }}
                             </x-slot>
     
                             <x-slot name="icon">
                                 <i class="fa fa-users" aria-hidden="true"></i>
                             </x-slot>
     
                             <x-slot name="link">
                                 <a href="{{ route('admin.users.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                             </x-slot>
                         </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                         <x-box.case class="bg-danger">
                             <x-slot name="count">
                                 {{ count($agents) }}
                             </x-slot>
     
                             <x-slot name="body">
                                {{ Illuminate\Support\Str::plural('Agent', count($agents)) }}
                             </x-slot>
     
                             <x-slot name="icon">
                                 <i class="fa fa-home" aria-hidden="true"></i>
                             </x-slot>
     
                             <x-slot name="link">
                                 <a href="{{ route('admin.agents.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                             </x-slot>
                         </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-box.case class="bg-success">
                            <x-slot name="count">
                                {{ count($writers) }}
                            </x-slot>
    
                            <x-slot name="body">
                                {{ Illuminate\Support\Str::plural('Writer', count($writers)) }}
                            </x-slot>
    
                            <x-slot name="icon">
                                <i class="fas fa-edit"></i>
                            </x-slot>
    
                            <x-slot name="link">
                                <a href="{{ route('admin.writers.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                            </x-slot>
                        </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-box.case class="bg-warning">
                            <x-slot name="count">
                                {{ count($vendors) }}
                            </x-slot>
    
                            <x-slot name="body">
                                {{ Illuminate\Support\Str::plural('Vendor', count($vendors)) }}
                            </x-slot>
    
                            <x-slot name="icon">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </x-slot>
    
                            <x-slot name="link">
                                <a href="{{ route('admin.vendors.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                            </x-slot>
                        </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-box.case class="bg-indigo">
                            <x-slot name="count">
                                {{ count($banks) }}
                            </x-slot>
    
                            <x-slot name="body">
                               {{ Illuminate\Support\Str::plural('Bank', count($banks)) }}
                            </x-slot>
    
                            <x-slot name="icon">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                            </x-slot>
    
                            <x-slot name="link">
                                <a href="{{ route('admin.banks.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                            </x-slot>
                        </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-box.case class="bg-secondary">
                            <x-slot name="count">
                                {{ count($products) }}
                            </x-slot>
    
                            <x-slot name="body">
                               {{ Illuminate\Support\Str::plural('Product', count($banks)) }}
                            </x-slot>
    
                            <x-slot name="icon">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                            </x-slot>
    
                            <x-slot name="link">
                                <a href="{{ route('admin.products.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                            </x-slot>
                        </x-box.case>
                    </div>
                    <div class="col-md-3 col-6">
                        <x-box.case class="bg-primary">
                            <x-slot name="count">
                                {{ count($orders) }}
                            </x-slot>
    
                            <x-slot name="body">
                               {{ Illuminate\Support\Str::plural('Order', count($banks)) }}
                            </x-slot>
    
                            <x-slot name="icon">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                            </x-slot>
    
                            <x-slot name="link">
                                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">See all <i class="fas fa-arrow-circle-right"></i></a>
                            </x-slot>
                        </x-box.case>
                    </div>
                </div>
            </div>
              
        </div>
    </div>
</x-app-layout>