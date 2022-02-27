<x-app-layout>
    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="project-detail-section">
                <div class="auto-container">
                    <!-- Upper Box -->
                    <div class="upper-box">
                        <div class="row clearfix">
        
                            <!-- Image Column -->
                            <div class="image-column col-lg-9 col-md-12 col-sm-12">
                                <div class="inner-column wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <div class="image">
                                        <img src="{{ asset('storage/'.$agent->image()) }}" alt="" />
                                    </div>
                                </div>
                            </div>
                            <!-- Info Column -->
                            <div class="info-column col-lg-3 col-md-12 col-sm-12">
                                <div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <h3>Agent Portfolio</h3>
                                    <ul class="info-list">
                                        <li>Agent Name:<span>{{ $agent->name() }}</span></li>
                                        <li>Location:<span>{{ $agent->address() }}</span></li>
                                        <li>Email:<span>{{ $agent->email() }}</span></li>
                                        <li>Phone Number:<span>{{ $agent->phone() }}</span></li>
                                        <li>
                                            Total 
                                            {{ Illuminate\Support\Str::plural('Property', $agent->vendorProperties()) }}
                                            :<span>{{ $agent->vendorProperties() }}</span></li>
                                        <li>Language:<span>{{ $agent->language() }}</span></li>
                                        <li>Company Owned by:<span>{{ $agent->user()->name() }}</span></li>
                                        <li>Social:
                                            <span>
                                                <div class="flex space-x-4">
                                                    <x-social.profile :author="$agent" />
                                                </div>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
        
                        </div>
                    </div>
        
                    <!-- Lower Content -->
                    <div class="lower-content">
                        <h2>About Agent {{ $agent->name() }}</h2>
        
                        <p>
                            {{ $agent->description() }}
                        </p>
        
                        {{-- <h3>Meet with {{ $agent->user->name() }} the owner of {{ $agent->name() }} </h3>
                        <p>
                            {{ $agent->user->profile->bio() }}
                        </p> --}}

                        <x-link.danger href="{{ route('smilee.agent.property', $agent) }}">
                            View Agent {{ $agent->name() }} Properties
                        </x-link.danger>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
