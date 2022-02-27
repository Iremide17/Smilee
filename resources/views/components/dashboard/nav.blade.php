<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm dropdown-legacy border-bottom-0">
    <!-- Left navbar links -->
   @auth
        @php
            $bookCount = App\models\Booking::where('author_id', auth()->user()->id())->where('status_id', 1)->count();
        @endphp
   @endauth

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

        @admin
            <li class="nav-item d-none d-sm-inline-block">
                    {{-- orders--}}
                    <x-jet-nav-link class="border-right mr-1" href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
            </li>
        @else
            <li class="nav-item d-none d-sm-inline-block">
                {{-- orders--}}
                <x-jet-nav-link class="border-right mr-1" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
            </li>
        @endadmin
      
      <li class="nav-item d-none d-sm-inline-block">
                {{-- booking--}}
        <x-jet-nav-link class="border-right mr-1" href="{{ route('booking', auth()->user()->username) }}" :active="request()->routeIs('booking', auth()->user()->username)">
            {{ __('Bookings') }}
            @if($bookCount != 0)
                <span class="badge badge-danger navbar-badge ml-4">{{ $bookCount }}</span>
            @endif
        </x-jet-nav-link>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
            {{-- orders--}}
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.order.show', auth()->user()->username()) }}" :active="request()->routeIs('smilee.order.show', auth()->user()->username())">
                {{ __('Orders') }}
            </x-jet-nav-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
                {{-- Tags--}}
                <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.vendors.index') }}" :active="request()->routeIs('smilee.vendors.index')">
                {{ __('Vendors') }}
            </x-jet-nav-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
           {{-- Tags--}}
           <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.tags.index') }}" :active="request()->routeIs('smilee.tags.index')">
            {{ __('Tags') }}
        </x-jet-nav-link>
      </li>

       {{-- Authors --}}
       <li class="nav-item d-none d-sm-inline-block">
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.authors.index') }}" :active="request()->routeIs('smilee.authors.index')">
                {{ __('Writers') }}
            </x-jet-nav-link>
       </li>

       {{-- Agents --}}
      <li class="nav-item d-none d-sm-inline-block">
        <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.agent.index') }}" :active="request()->routeIs('smilee.agent.index')">
                {{ __('Agents') }}
        </x-jet-nav-link>
     </li>

      {{-- threads --}}
        <li class="nav-item d-none d-sm-inline-block">
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.threads.index') }}" :active="request()->routeIs('smilee.threads.index')">
                <i class="fa fa-question" aria-hidden="true"></i>  {{ __('Threads') }}
            </x-jet-nav-link>
        </li>

        </ul>

    <!-- Right navbar links -->

    <ul class="ml-auto navbar-nav">

    @auth

        <!-- baskets -->
        <livewire:pages.nav.bookings.indicator>

        <!-- carts -->
        <livewire:pages.nav.carts.indicator>

        <!-- Notifications -->
        <livewire:pages.nav.notifications.indicator>

          <!-- Settings Dropdown -->
        <div class="relative ml-3">
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                    @else
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            {{ Auth::user()->name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-jet-dropdown-link>

                    {{-- vendor dashboard --}}
                    @vendor
                        <x-jet-dropdown-link href="{{ route('vendor.index') }}" x-ref="vendorLink">
                            {{ __('Dashboard Edit') }}
                        </x-jet-dropdown-link>
                    @endvendor

                    {{-- agent dashboard --}}
                    {{-- @agent
                        <x-jet-dropdown-link href="{{ route('agents.dashboard.index', auth()->user()->agent) }}">
                            {{ __('Agent Dashboard') }}
                        </x-jet-dropdown-link>
                    @endagent --}}

                    {{-- post dashboard --}}
                    {{-- @writer
                        <x-jet-dropdown-link href="{{ route('dashboard.posts.index') }}">
                            {{ __('Create Post') }}
                        </x-jet-dropdown-link>
                    @endwriter --}}

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                    </form>
                </x-slot>
            </x-jet-dropdown>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                    @endif

                    <div>
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>
                    
                    @admin
            <li class="nav-item d-none d-sm-inline-block">
                    {{-- orders--}}
                    <x-jet-nav-link class="border-right mr-1" href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
            </li>
        @else
            <li class="nav-item d-none d-sm-inline-block">
                {{-- orders--}}
                <x-jet-nav-link class="border-right mr-1" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
            </li>
        @endadmin
      
      <li class="nav-item d-none d-sm-inline-block">
                {{-- booking--}}
        <x-jet-nav-link class="border-right mr-1" href="{{ route('booking', auth()->user()->username) }}" :active="request()->routeIs('booking', auth()->user()->username)">
            {{ __('My Bookings') }}
            @if($bookCount != 0)
                <span class="badge badge-danger navbar-badge ml-4">{{ $bookCount }}</span>
            @endif
        </x-jet-nav-link>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
            {{-- orders--}}
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.order.show', auth()->user()->username()) }}" :active="request()->routeIs('smilee.order.show', auth()->user()->username())">
                {{ __('My Orders') }}
            </x-jet-nav-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
                {{-- Tags--}}
                <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.vendors.index') }}" :active="request()->routeIs('smilee.vendors.index')">
                {{ __('Vendors') }}
            </x-jet-nav-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
           {{-- Tags--}}
           <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.tags.index') }}" :active="request()->routeIs('smilee.tags.index')">
            {{ __('Tags') }}
        </x-jet-nav-link>
      </li>

       {{-- Authors --}}
       <li class="nav-item d-none d-sm-inline-block">
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.authors.index') }}" :active="request()->routeIs('smilee.authors.index')">
                {{ __('Writers') }}
            </x-jet-nav-link>
       </li>

       {{-- Agents --}}
      <li class="nav-item d-none d-sm-inline-block">
        <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.agent.index') }}" :active="request()->routeIs('smilee.agent.index')">
                {{ __('Agents') }}
        </x-jet-nav-link>
     </li>

      {{-- threads --}}
        <li class="nav-item d-none d-sm-inline-block">
            <x-jet-nav-link class="border-right mr-1" href="{{ route('smilee.threads.index') }}" :active="request()->routeIs('smilee.threads.index')">
                <i class="fa fa-question" aria-hidden="true"></i>  {{ __('Threads') }}
            </x-jet-nav-link>
        </li>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @endauth

    </ul>
</nav>

