<aside class="main-sidebar sidebar-light-danger elevation-5">
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

                  <x-sidenav.link href="{{ route('smilee.properties.index') }}" :active="request()->routeIs('smilee.properties.index')">
                    <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                    <p class="ml-3 ">
                        Properties
                    </p>
                  </x-sidenav.link>

                </li>

                {{-- blog --}}
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

                <li class="nav-item mt-2">
                    <div>
                        {{-- Start Discusson Button --}}
                        <a href="{{ route('smilee.threads.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25" }}>
                            {{ __('Start a new discussion') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item">

                    {{-- Users --}}
                    <div>
                        <x-sidenav.title>
                            {{ __('Modules') }}
                        </x-sidenav.title>

                        <div>
                            <x-sidenav.link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                                <x-zondicon-user-group class="w-3 text-theme-blue-100" />
                                <span>{{ __('Users') }}</span>
                            </x-sidenav.link>
                        </div>

                        <div>
                            <x-sidenav.link href="{{ route('admin.setting.index') }}" :active="request()->routeIs('admin.setting.index')">
                                <x-zondicon-compose class="w-3 text-theme-blue-100" />
                                <span>{{ __('Setting') }}</span>
                            </x-sidenav.link>
                        </div>
                    </div>

                </li>

                <li class="nav-item mt-6">
                    <div>
                        <x-sidenav.title>
                            {{ __('Writers') }}
                        </x-sidenav.title>
            
                        <div>
                            <x-sidenav.link href="{{ route('admin.writers.index') }}" :active="request()->routeIs('admin.writers.index')">
                                <x-zondicon-user-group class="w-3 text-theme-blue-100" />
                                <span>{{ __('index') }}</span>
                            </x-sidenav.link>
                        </div>
            
                        <div>
                            <x-sidenav.link href="{{ route('admin.posts.create') }}" :active="request()->routeIs('admin.posts.create')">
                                <x-zondicon-compose class="w-3 text-theme-blue-100" />
                                <span>{{ __('Post Create') }}</span>
                            </x-sidenav.link>
                        </div>
                    </div>
                </li>

                <li class="nav-item mt-6">
                    {{-- Tag --}}
                    <div>
                        <x-sidenav.title>
                            {{ __('Tag') }}
                        </x-sidenav.title>
                        <div>
                            <x-sidenav.link href="{{ route('admin.tags.index') }}" :active="request()->routeIs('admin.tags.index')">
                                <x-zondicon-tag class="w-3 text-theme-blue-100" />
                                <span>{{ __('index') }}</span>
                            </x-sidenav.link>
                        </div>
            
                        <div>
                            <x-sidenav.link href="{{ route('admin.tags.create') }}" :active="request()->routeIs('admin.tags.create')">
                                <x-zondicon-compose class="w-3 text-theme-blue-100" />
                                <span>{{ __('Create') }}</span>
                            </x-sidenav.link>
                        </div>
                    </div>
                </li>

                <li class="nav-item mt-6">
                     {{-- Auth --}}
                    <div>
                        <x-sidenav.title>
                            {{ __('Authentication') }}
                        </x-sidenav.title>
                        <div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-sidenav.link href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                    <x-heroicon-o-logout class="w-4 text-theme-blue-100" />
                                    <span>{{ __('Logout') }}</span>
                                </x-sidenav.link>

                            </form>

                        </div>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>