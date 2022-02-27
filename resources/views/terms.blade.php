<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
         {{ __('Terms and Condition') }}
        </h2>
        <p>
            This is {{ application('name') }} terms and condition page!
        </p>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <section class="our-terms pb70">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xl-9">
                            <div class="terms_condition_grid">
                                <div class="grids mb60">

                                    <h4 class="title">Privacy Policy</h4>

                                    <p class="mb25">
                                        {{ application('policy') }}
                                    </p>
                                </div>

                                <div class="grids mb30">
                                    <h4 class="title">Our Terms</h4>
                                    <p class="mb25">
                                        {{ application('terms') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
