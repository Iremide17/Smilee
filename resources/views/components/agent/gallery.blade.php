<div class="gallery-block-five col-lg-4 col-md-6 col-sm-12" style="display: inline-block;">
    <div class="inner-box">
        <div class="image">
            <img src="{{ asset('storage/'. $agent->image()) }}" alt="{{ $agent->name() }}">
            <div class="overlay-box">
                <div class="content">
                    <a href="{{ asset('storage/'. $agent->image()) }}" data-fancybox="gallery-page" data-caption="" class="lightbox-image plus"><i class="fa fa-plus" aria-hidden="true"></i></a>
                    <div class="overlay-lower-content">
                        <div class="title">Rank: {{ $agent->user()->rank() }}</div>
                        <h5><a href="{{ route('smilee.agent.show',$agent) }}">{{ $agent->name() }}</a></h5>
                        <div class="details mt-1 text-white">
                            {{-- Socials --}}
                            <div class="flex space-x-4">
                                <x-social.profile :author="$agent" />
                            </div>
                            <div class="fp_footer">
                                <a class="fp_pdate float-left text-white" href="{{ route('smilee.agent.show',$agent) }}">Goto Agent Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>