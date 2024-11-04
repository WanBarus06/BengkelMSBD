"# BengkelMSBD" 


## **Cara Setup Projek**

- git clone https://github.com/WanBarus06/BengkelMSBD.git
  Clone repository ke dalam folder

- cd <nama-folder-proyek>
   | Masuk ke dalam folder
- composer install
   | Install dependensi backend
- npm install
   | Install dependensi frontend
  
- cp .env.example .env
   | Ambil env.example sebagai contoh file .env yang akan digunakan

- php artisan key:generate
   | Lakukan generate terhadap api key dan letakan di file .env
- php artisan migrate --seed
   | Jalankan migrate database
  
- npm run dev
- php artisan serve
 
