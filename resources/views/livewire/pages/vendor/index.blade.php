<div>
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @forelse ($vendors as $vendor)
                        <x-agent.card :model="$vendor">
                            <x-slot name="image">
                                <a href="{{ route('smilee.vendors.show', $vendor) }}">
                                    <img class="img-whp" src="{{ asset('storage/'.$vendor->banner()) }}" alt="{{ $vendor->name() }}">
                                </a>
                            </x-slot>
                            <x-slot name="details">
                                <x-slot name="small">
                                    <a href="{{ route('smilee.vendors.show', $vendor) }}">
                                        <img src="{{ asset('storage/'.$vendor->image()) }}" alt="{{ $vendor->name() }}">
                                    </a>
                                </x-slot>
                                <x-slot name="name">
                                    <h4 class="">
                                        <a href="{{ route('smilee.vendors.show', $vendor) }}">{{ $vendor->name() }}</a>
                                    </h4>
                                    <span>
                                        <i class="fa fa-home" aria-hidden="true"></i>: {{ $vendor->vendorProducts() }}
                                    </span>
                                    <span>
                                        <i class="fas fa-image"></i>: {{ $vendor->vendorGalleries() }}
                                    </span>
                                </x-slot>
                            </x-slot>
                        </x-agent.card>
                    @empty
                       <p>No vendors available</p>
                   @endforelse
            </div>

            {{-- load more --}}
            <x-alerts.loadmore :models="$vendors"/>
            
        </div>
    </div>

    {{-- @push('scripts')
        <script defer>
            function initialize() {

                var mapOptions = {
                    zoom: 12,
                    minZoom: 6,
                    maxZoom: 17,
                    zoomControl:true,
                    zoomControlOptions: {
                        style:google.maps.ZoomControlStyle.DEFAULT
                    },
                    center: new google.maps.LatLng({{ $latitude }}, {{ $longitude }}),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    panControl:false,
                    mapTypeControl:false,
                    scaleControl:false,
                    overviewMapControl:false,
                    rotateControl:false
                }

                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                var image = new google.maps.MarkerImage("img/default/pin.png", null, null, null, new google.maps.Size(40,52));
                var places = @json($mapVendors);

                for(place in places)
                {
                    place = places[place];
                    if(place.latitude && place.longitude)
                    {
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(place.latitude, place.longitude),
                            icon:image,
                            map: map,
                            title: place.name
                        });
                        var infowindow = new google.maps.InfoWindow();
                        google.maps.event.addListener(marker, 'click', (function (marker, place) {
                            return function () {i
                                infowindow.setContent(generateContent(place))
                                infowindow.open(map, marker);
                            }
                        })(marker, place));
                    }
                }
            }
            google.maps.event.addDomListener(window, 'load', initialize);

            function generateContent(place)
            {
                var content = `
                    <div class="gd-bubble" style="">
                        <div class="gd-bubble-inside">
                            <div class="geodir-bubble_desc">
                            <div class="geodir-bubble_image">
                                <div class="geodir-post-slider">
                                    <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                        <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                            <ul class="geodir-post-image geodir-images clearfix">
                                                <li>
                                                    <div class="geodir-post-title">
                                                        <h4 class="geodir-entry-title">
                                                            <a href="{{ route('smilee.vendors.show', '') }}/`+place.slug+`" title="View: `+place.name+`">`+place.name+`</a>
                                                        </h4>
                                                    </div>
                                                    <a href="{{ route('smilee.vendors.show', '') }}/`+place.slug+`"><img src="`+place.thumbnail+`" alt="`+place.name+`" class="align size-medium_large" width="1400" height="930"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="geodir-bubble-meta-side">
                            <div class="geodir-output-location">
                            <div class="geodir-output-location geodir-output-location-mapbubble">
                                <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                                    <i class="fas fa-minus" aria-hidden="true"></i>
                                    <span class="geodir_post_meta_title">Place Title: </span></span>`+place.name+`</div>
                                <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                                    <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                    <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">`+place.address+`</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>`;

                return content;

            }
        </script>
    @endpush --}}
</div>


