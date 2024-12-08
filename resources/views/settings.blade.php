<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaturan</title>
  
  <!-- Favicon -->
  <link href="../assets/img/favicon.ico" rel="icon">
  
  <!-- Google Web Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Template Stylesheet -->
  <link href="../assets/css/settings.css" rel="stylesheet">
  <link href="../assets/css/user.css" rel="stylesheet">

  <style>
      /* Basic layout for form sections */
      .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
      }
      .link-container {
          display: flex;
          gap: 15px;
          margin-bottom: 20px;
      }
      .tab {
          cursor: pointer;
      }
      .tab.active {
          font-weight: bold;
          color: white;
      }
      .section {
          display: none;
      }
      .section.active {
          display: block;
      }

      /* Styles for labels and inputs */
      label {
          display: block;
          margin: 10px 0 5px;
      }
      input[type="text"],
      input[type="email"],
      input[type="tel"],
      input[type="password"] {
          width: 100%;
          padding: 8px;
          margin-bottom: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
      }

      /* Confirmation radio buttons */
      .confirmation-container {
          margin-top: 15px;
      }
      .confirmation-option {
          display: flex;
          align-items: center;
          gap: 10px;
      }
      .confirmation-option label {
          margin-right: 5px;
      }

      /* Align radio buttons and labels horizontally */
      .radio-group {
          display: flex;
          gap: 20px;
          margin-top: 5px;
      }

      /* Button styles */
      .buttons {
          display: flex;
          gap: 10px;
          margin-top: 15px;
      }
  </style>
</head>
<body>
  <div class="container">
    <div class="link-container">
      <span class="tab"><a href="{{ route('home') }}" class="fa fa-home me-3"></a></span>
      <span class="tab" onclick="showSection('edit-profile')">Edit Profil</span>
      <span class="tab" onclick="showSection('change-password')">Ubah Sandi</span>
      <span class="tab" onclick="showSection('delete-account')">Hapus Akun</span>
    </div>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
      @csrf
    </form>

    <div id="edit-profile" class="section active">
      <h2 class="m-0 text-primary">Kelola Akun Anda</h2>
      <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <label for="name">Nama Lengkap</label>
        {{-- <input type="text"
        id="name"
        placeholder="Nama Lengkap"
        name="name"
        :value="old('name', $user->name)"> --}}
        <x-text-input id="name" name="name" type="text" class="text-gray-500 mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />

        <label for="email">Email</label>
        {{-- <input type="email" 
        id="email" 
        placeholder="Email"
        name="email"
        :value="old('email', $user->email)"> --}}
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" disabled required/>
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        <label for="phone">No. Telepon</label>
        {{-- <input type="number" \
        id="phone" 
        placeholder="Nomor Telepon"
        name="phone_number"
        :value="old('email', $user->phone_number)"> --}}
        <x-text-input id="phone_number" name="phone_number" type="number" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)"/>
        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />

        <label for="address">Alamat</label>
        {{-- <input type="text" id="address" placeholder="Alamat"> --}}
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />

        <div class="buttons">
          <button type="submit" class="save-btn">Simpan Perubahan</button>
        </div>
      </form>
      @if (session('status') === 'profile-updated')
      <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400"
      >{{ __('Saved.') }}</p>
      @elseif (session('status') === 'failed')
      <p
          x-data="{ show: false }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400"/>
          {{ __('Failed.') }}
      @endif
    </div>

    <div id="change-password" class="section">
      <h2 class="m-0 text-primary">Kelola Keamanan Akun Anda</h2>
      <form action="{{ route('password.update') }}" method = "POST">
        @csrf
        @method('put')

        <label for="email-password">Password Lama</label>
        <x-text-input id="update_password_current_password" name="current_password" type="password" class="" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-600" />

        <label for="new-password">Password Baru</label>
        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-600" />

        <label for="confirm-password">Konfirmasi Password</label>
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-600" />

        <div class="buttons">
          <button type="submit" class="save-btn">Simpan Perubahan</button>
        </div>
      </form>
      @if (session('status') === 'password-updated')
      <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400"
      >{{ __('Saved.') }}</p>
      @elseif (session('status') === 'failed')
      <p
          x-data="{ show: false }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400"/>
          {{ __('Failed.') }}
      @endif
    </div>

    <div id="delete-account" class="section">
      <h2 class="m-0 text-primary">Hapus Akun Anda</h2>
      <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <label for="new-password">Masukkan Password Anda</label>
        <x-text-input
          id="password"
          name="password"
          type="password"
          class="mt-1 block w-3/4"
          placeholder="{{ __('Password') }}"
          />

          <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

        {{-- <div class="confirmation-container">
          <p>Apa Anda Yakin Untuk Menghapus Akun?</p>
          <div class="toggle-buttons">
              <button type="button" class="toggle-button" id="yes-btn" onclick="selectOption('yes')">Yes</button>
              <button type="button" class="toggle-button" id="no-btn" onclick="selectOption('no')">No</button>
          </div>
        </div> --}}

        <div class="buttons">
          <button type="submit" class="save-btn">Hapus Akun</button>
        </div>
      </form>
    </div>
  </div>

  <script>
  // Function to show specific sections and manage active tab classes
  function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));

    // Remove active class from all tabs
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Show selected section and add active class to the corresponding tab
    document.getElementById(sectionId).classList.add('active');
    document.querySelector(`[onclick="showSection('${sectionId}')"]`).classList.add('active');
  }

  // Function to toggle "Yes" and "No" options in the delete confirmation section
  function selectOption(option) {
    // Get the buttons
    const yesBtn = document.getElementById("yes-btn");
    const noBtn = document.getElementById("no-btn");

    // Toggle active class based on selection
    if (option === 'yes') {
      yesBtn.classList.add("active");
      noBtn.classList.remove("active");
    } else {
      noBtn.classList.add("active");
      yesBtn.classList.remove("active");
    }
  }
</script>

</body>
</html>