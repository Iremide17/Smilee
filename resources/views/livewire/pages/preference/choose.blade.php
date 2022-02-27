<div class="row clearfix">
    <x-alerts.loading/>
                                
    <!-- Service Block -->
    <div class="service-block col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="background-image: url(&quot;{{ asset('img/resource/service-1.png') }}&quot;); visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
            <div class="icon-box">
                <span class="icon"><img src="{{ asset('img/icons/service-icon-1.png') }}" alt=""></span>
            </div>
            <div class="content">
                <h3 class="cursor-pointer"><a wire:click.prevent="addNew('agent')">Agent</a></h3>
                <div class="text">We have seen great successes with everyone companies.</div>
                <a wire:click.prevent="addNew('agent')" class="read-more cursor-pointer">Choose</a>
            </div>
            <div class="pattern-layer" style="background-image:url({{ asset('img/background/service-pattern-1.png') }})"></div>
        </div>
    </div>
    
    <!-- Service Block -->
    <div class="service-block col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box wow fadeInUp animated" 
                data-wow-delay="0ms" data-wow-duration="1500ms" 
                style="background-image: url(&quot;{{ asset('img/resource/service-2.png') }}&quot;); visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
            <div class="icon-box">
                <span class="icon"><img src="{{ asset('img/icons/service-icon-2.png') }}" alt=""></span>
            </div>
            <div class="content">
                <h3 class="cursor-pointer"><a wire:click.prevent="addNew('vendor')">Vendor</a></h3>
                <div class="text">You make sure you know how campaign is performing.</div>
                <a wire:click.prevent="addNew('vendor')" class="read-more cursor-pointer">Choose</a>
            </div>
            <div class="pattern-layer" style="background-image:url({{ asset('img/background/service-pattern-2.png') }})"></div>
        </div>
    </div>
    
    <!-- Service Block -->
    <div class="service-block col-lg-4 col-md-6 col-sm-12">
        <div class="inner-box wow fadeInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms" 
                    style="background-image: url(&quot;{{ asset('img/resource/service-3.png') }}&quot;); visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
            <div class="icon-box">
                <span class="icon"><img src="{{ asset('img/icons/service-icon-3.png') }}" alt=""></span>
            </div>
            <div class="content">
                <h3 class="cursor-pointer"><a wire:click.prevent="addNew('writer')">Writer</a></h3>
                <div class="text">To generate highly focused leads ready to purchases.</div>
                <a wire:click.prevent="addNew('writer')" class="read-more cursor-pointer">Choose</a>
            </div>
            <div class="pattern-layer" style="background-image:url({{ asset('img/background/service-pattern-3.png') }})"></div>
        </div>
    </div>
    @include('livewire.pages.preference.create')
</div>