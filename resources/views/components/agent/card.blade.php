<div class="col-md-6 col-xl-3 transition duration-500 transform shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
    <div class="feat_property">
        <div class="thumb"> 

            @isset($image)
                {{ $image}}
            @endisset
            
            @isset($sub)
                <div class="thmb_cntnt">
                    @isset($price)
                        {{ $price }}
                    @endisset

                    @isset($type)
                        {{ $type }}
                    @endisset
                </div>
            @endisset
           
            @isset($availaible)
                <div class="thmb_cntnt2">
                    <ul class="listing_gallery mb0">
                        <li class="list-inline-item">
                            <a class="text-white" href="#">
                                <span class="flaticon-photo-camera mr5"></span>
                                @isset($visible)
                                    {{ $visible }}
                                @endisset
                            </a>
                        </li>
                    </ul>
                </div>
            @endisset

        </div>

        @isset($details)
            <div class="details">
                <div class="tc_content">
                    @isset($small)
                        <div class="badge_icon">
                            {{ $small }}
                        </div>
                    @endisset

                    @isset($name)
                        <div class="flex flex-row space-x-4 font-bold text-sm">
                            {{ $name }}
                        </div>
                    @endisset
                    @isset($prop)
                        {{ $prop }}
                    @endisset

                </div>

                @isset($book)
                    <livewire:pages.agent.book :property="$model" :key="$model->id"/>
                @endisset
            </div>
        @endisset
    </div>
</div>
