
<x-guest-layout>
<link rel="stylesheet" href="../assets/css/login-register.css">
<div class="wrapper">
    <div class="title-text">
      <div class="title login">Registrasi</div>
    </div>
    <div class="form-container">
      <div class="form-inner">
        <form action="{{ route('register') }}" method="POST">
          @csrf

          <div class="field">
              <label for="name" class="block text-gray-600">Nama Lengkap</label>
              <input 
              type="text"
              id="name"
              name="name"
              class="w-full border border-gray-30"
              autocomplete="off"
              :value="old('name')">
          </div>
          <br><x-input-error :messages="$errors->get('name')" class="mt-2" />

          <br><div class="field">
              <label for="email" class="block text-gray-600">Email</label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                class="w-full border border-gray-300" 
                autocomplete="off"
                :value="old('email')"
              >
          </div>
          <br><x-input-error :messages="$errors->get('email')" class="mt-2" />

          <br><div class="field">
            <label for="password" class="block text-gray-800">Password</label>
            <input type="password"
              id="password" 
              name="password" \
              class="w-full border border-gray-300" 
              autocomplete="off"
              :value="old('password')">
          </div>
          <br><x-input-error :messages="$errors->get('password')" class="mt-2" />

          <br><div class="field">
              <label for="password_confirmation" class="block text-gray-800">Konfirmasi Password</label>
              <input 
              type="password"
              id="password_confirmation" 
              name="password_confirmation" \
              class="w-full border border-gray-300" 
              autocomplete="off"
              :value="old('password_confirmation')">
          </div>
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      
          {{-- <div class="mb-4">
            <label for="phone" class="block text-gray-800">Nomor Telepon</label>
            <input type="phone" id="phone" name="phone" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off">
          </div> --}}
      
          <br><br><button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded-md py-2 px-4 w-full">
              {{ __('Daftar') }}
          </button>
          <div class="signup-link">
            <p >Sudah mempunyai akun? Anda bisa melakukan <a href="/login" class="hover:underline text-red-500">login </a>disini</p>
          </div>
        </form>

  {{-- <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <!-- Email Address -->
      <div class="mt-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" />

          <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

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
          <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
              {{ __('Already registered?') }}
          </a>

          <x-primary-button class="ms-4">
              {{ __('Register') }}
          </x-primary-button>
      </div>
  </form> --}}
</x-guest-layout>