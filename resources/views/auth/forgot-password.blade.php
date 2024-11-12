<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <main id="content" role="main" class="w-full max-w-md mx-auto p-6">
        <div class="h-1/2 bg-white rounded-xl shadow-lg border-2 border-sky-100">
          <div class="p-4 sm:p-7">
            <div class="text-center">
              <h1 class="block text-2xl font-bold text-gray-800 ">Forgot password?</h1> 
              <p class="mt-2 text-sm text-gray-600 ">
                Remember your password?
                <a class="text-blue-600 decoration-2 hover:underline font-medium" href="#">
                  Login here
                </a>
              </p>
            </div>
    
            <div class="mt-5">
              <form method="POST" action="{{ route('password.email') }}">

                @csrf
                <div class="grid gap-y-4">
                  <div>
                    <label for="email" class="block text-sm font-bold ml-1 mb-2 ">Email address</label>
                    <div class="relative">
                      <input 
                      type="email" 
                      id="email" 
                      name="email" 
                      class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                      required aria-describedby="email-error"
                      :value="old('email')">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      
                    </div>
                    <p class="hidden text-xs text-red-600 mt-2" id="email-error">Please include a valid email address so we can get back to you</p>
                  </div>
                  <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm ">{{ __('Email Password Reset Link') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    {{-- <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
