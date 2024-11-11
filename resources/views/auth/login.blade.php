<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-sky-100 flex justify-center items-center h-screen">
        <div class="w-1/2 h-screen hidden lg:block relative">
            <img src="../assets/img/login.png" alt="Gambar" class="object-cover w-full h-full">
    </div>
    <div class= "lg:p-32 md:p-52 sm:20 p-6 w-full lg:w-1/2 bg-white">
      <h1 class="text-4xl font-semibold mb-8">Selamat datang</h1>
      <form action="{{ route('login') }}" method="POST">
    
        <div class="mb-4" "bg-sky-100">
          <label for="email" class="block text-gray-600">Email</label>
          <input 
          type="email" 
          id="email" 
          name="email" 
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" 
          autocomplete="off"
          :value="old('email')">
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    
        <div class="mb-5">
          <label for="password" class="block text-gray-800">Password</label>
          <input 
          type="password" 
          id="password" 
          name="password" 
          class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" 
          autocomplete="off"
          :value="old('password')">
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    
        <div class="mb-5 flex items-center">
          <input type="checkbox" id="remember" name="remember" class="text-red-500">
          <label for="remember" class="text-green-900 ml-2">{{ __('Remember me') }}</label>
        </div>
    
        <div class="mb-6 text-blue-500">
          @if (Route::has('password.request'))
            <a class="hover:underline" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
          @endif
        </div>
    
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md py-2 px-4 w-full">{{ __('Log in') }}</button>
      </form>
      <div class="mt-6 ">
        <p >Belum mempunyai akun? Silahkan <a href="/register" class="hover:underline text-red-500">daftar </a>terlebih dahulu.</p>
      </div>
    </div>
    </div>

    {{-- Default Breeze do not Remove --}}
    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
