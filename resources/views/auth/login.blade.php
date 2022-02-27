<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-logos.main class="brand-image img-circle elevation-3"
            style="opacity: .8" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="py-12">
            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="signup-form text-center">
                <p class="hint-text">Sign in with your social media account or email address</p>

                <div class="social-btn text-center">
                    <a href="{{ route('facebook.login') }}" class="btn btn-primary btn-lg"><i class="fa fa-facebook"></i> Facebook</a>
                    <a href="{{ route('google.login') }}" class="btn btn-danger btn-lg"><i class="fab fa-google-plus"></i> Google</a>
                </div>
                <div class="or-seperator"><b>or</b></div>
            </div>

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                    <a class="text-sm hover:text-gray-900 mr-2" href="{{ route('register') }}">
                        {{ __('Create account') }}
                    </a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
