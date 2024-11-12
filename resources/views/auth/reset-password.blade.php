<x-guest-layout>

    <main id="content" role="main" class="w-full max-w-md mx-auto p-6">
        <div class="h-1/2 bg-white rounded-xl shadow-lg border-2 border-sky-100">
          <div class="p-4 sm:p-7">
            <div class="text-center">
              <h1 class="block text-2xl font-bold text-gray-800 ">Change Your Password</h1> 
            </div>
            <div class="mt-5">
              <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="grid gap-y-4">
                  <div>
                    <label for="email" class="block text-sm text-black font-bold ml-1 mb-2 ">Email address</label>
                    <div class="relative">
                        <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                        value="{{ old('email', $request->email) }}"
                        readonly
                        required autofocus
                    />
                    <x-text-input id="email" class=" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    </div>
                  </div>

                  <div>
                    <label for="password" class="block text-sm font-bold ml-1 mb-2 ">New Password</label>
                    <div class="relative">
                      <input 
                      type="password" 
                      id="password" 
                      name="password" 
                      class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                      required autocomplete="new-password"
                      :value="old('password')">
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />  
                    </div>
                  </div>

                  <div>
                    <label for="email" class="block text-sm font-bold ml-1 mb-2 ">Password Confirmation</label>
                    <div class="relative">
                      <input 
                      type="password" 
                      id="password_confrimation" 
                      name="password_confirmation" 
                      class="py-3 px-4 block w-full border-2 border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                      required autocomplete="new-password"
                      :value="old('password_confirmation')">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                  </div>

                  <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm ">{{ __('Reset Password') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    {{-- <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
