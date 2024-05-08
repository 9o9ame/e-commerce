<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end my-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="form-group text-center">

            <label for="name" class="col-md-4 control-label">Login With</label>

            <div class="col-md-12">

                <a href="{{ url('auth/facebook') }}" class="btn btn-social-icon btn-facebook" style="font-size: 30px; padding: 3px;"><i class="fab fa-facebook"></i></a>

                <a href="{{ url('auth/google') }}" class="btn btn-social-icon btn-google-plus" style="font-size: 30px; padding: 3px;"><i class="fab fa-google-plus"></i></a>

                <a href="{{ url('auth/linkedin') }}" class="btn btn-social-icon btn-linkedin" style="font-size: 30px; padding: 3px;"><i class="fab fa-linkedin"></i></a>

                <a href="{{ url('auth/apple') }}" class="btn btn-social-icon btn-apple-pay" style="font-size: 30px; padding: 3px;"><i class="fab fa-apple-pay"></i></i></a>

                {{-- <a href="{{ url('login/twitter') }}" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>

                <a href="{{ url('login/github') }}" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>

                <a href="{{ url('login/bitbucket') }}" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a> --}}

            </div>

        </div>
    </form>
</x-guest-layout>
