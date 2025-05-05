

{{-- <x-guest-layout>
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

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
  --}}


  @extends('layout.app')

  @section('content')
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login to your account</h2>

          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <!-- Login Form -->
          <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email Address -->
              <div>
                  <x-input-label for="email" :value="__('Email')" />
                  <x-text-input id="email" class="block mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>

              <!-- Password -->
              <div class="mt-4">
                  <x-input-label for="password" :value="__('Password')" />
                  <x-text-input id="password" class="block mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="current-password" />
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

              <!-- Remember Me -->
              <div class="block mt-4">
                  <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                      <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                  </label>
              </div>

              <div class="flex items-center justify-between mt-6">
                  <!-- Forgot Password Link -->
                  @if (Route::has('password.request'))
                      <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                          {{ __('Forgot your password?') }}
                      </a>
                  @endif

                  <!-- Login Button -->
                  <x-primary-button class="ml-3">
                      {{ __('Log in') }}
                  </x-primary-button>
              </div>
          </form>
      </div>
  </div>
  @endsection
