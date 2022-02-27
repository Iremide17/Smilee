<aside class="main-sidebar sidebar-light-danger elevation-5">
    @php
            $bookCount = App\models\Booking::where('author_id', auth()->user()->id())->where('status_id', 1)->count();
    @endphp
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <x-logos.main class="brand-image img-circle elevation-3"
            style="opacity: .8" />
        <span class="brand-text font-weight-light">{{ application('name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth
            <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                <div class="image">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                </div>
                <div class="info">
                    <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
        @endauth

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <div>
                        {{-- Start Discusson Button --}}
                        <a href="{{ route('smilee.threads.create') }}" 
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest 
                        text-white uppercase transition bg-blue-500 border border-transparent rounded hover:bg-blue-400 
                        active:bg-blue-600 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25" }}>
                            {{ __('Start a new discussion') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item">

                    <x-sidenav.link href="{{ route('smilee.properties.index') }}" :active="request()->routeIs('smilee.properties.index')">
                      <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                      <p class="ml-3 ">
                          Properties
                      </p>
                    </x-sidenav.link>
  
                </li>
  
                <li class="nav-item">
  
                      <x-sidenav.link href="{{ route('smilee.posts.index') }}" :active="request()->routeIs('smilee.posts.index')">
                          <i class="fa fa-file nav-icon" aria-hidden="true"></i>
                        <p class="w-3 ml-3 ">
                          Blog
                        </p>
                      </x-sidenav.link>
  
                </li>
  
                  {{-- shop --}}
                <li class="nav-item">
  
                      <x-sidenav.link href="{{ route('smilee.products.index') }}" :active="request()->routeIs('smilee.products.index')">
                          <i class="fa fa-shopping-bag nav-icon" aria-hidden="true"></i>
                        <p class="w-3 ml-3 ">
                          Shop
                        </p>
                      </x-sidenav.link>
                  </li>

                <li class="nav-item">

                    <x-sidenav.link href="{{ route('terms.show') }}" :active="request()->routeIs('terms.show')">
                        <i class="fa fa-info nav-icon" aria-hidden="true"></i>
                        <p class="w-3 ml-3 ">
                            About
                        </p>
                    </x-sidenav.link>

                </li>

                <li class="nav-item mt-6">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-sidenav.link href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                             <i class="fa fa-arrow-circle-left nav-icon" aria-hidden="true"></i>
                             <p class="font-sm ml-3 ">
                               Logout
                             </p>
                        </x-sidenav.link>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
