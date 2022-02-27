<div class="related-projects-section">

    <div class="auto-container">

        <div class="row mt-1 mb-1">
            <div class="col-sm-12 mb-2">
                @include('partials.map')
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="my-select">Type
                            @if($type != null) <a wire:click="clearSearchTypeFilter">
                                <i class="fa fa-times text-red-500 font-bold text-sm ml-2 cursor-pointer btn btn-default" aria-hidden="true"> clear search </i></a> @endif
                        </label>
                        <select id="my-select" class="form-control" wire:model="type">
                                <option>Select Option</option>
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                        </select>
                    </div>
    
                    <div class="col-md-6">
                        <label for="my-select">Search
                            @if($searchTerm != null) <a wire:click="clearSearchTermFilter">
                            <i class="fa fa-times text-red-500 font-bold text-sm ml-2 cursor-pointer btn btn-default" aria-hidden="true"> clear search </i></a> @endif
                        </label>
                        <input type="text" class="form-control w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" wire:model.debounce.350ms="searchTerm" placeholder="Search for...">
                    </div>
    
                </div>
            </div>
        </div>

        <div class="row clearfix">
            @foreach ($properties as $property)
                <x-agent.property :property="$property"/>
            @endforeach
        </div>

        <x-alerts.loadmore :models="$properties"/>
        
    </div>
</div>


@push('scripts')
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
            var places = @json($mapProperties);

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
@endpush